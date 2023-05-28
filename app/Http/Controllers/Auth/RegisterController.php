<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Models\{User, Role};
use App\Jobs\SendRegistrationMailJob;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\{JsonResponse, RedirectResponse};
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\{DB, Hash, Log};

final class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function register(RegisterRequest $request): JsonResponse|RedirectResponse
    {
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        SendRegistrationMailJob::dispatch($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    protected function create(array $data)
    {
        try {
            DB::beginTransaction();

            $newUser = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $amdCreator = Role::where('slug', 'amd-creator')->first();

            $newUser->roles()->attach($amdCreator);

            DB::commit();

            return $newUser;
        } catch (\Exception $e) {
            DB::rollback();

            Log::error($e->getMessage());
        }
    }
}
