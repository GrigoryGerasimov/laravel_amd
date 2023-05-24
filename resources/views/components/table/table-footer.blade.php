<tfoot>
<tr>
    @if($isDetailed)
        <td colspan='16'>
            <x-common.button-link
                styling='outline'
                category='dark'
                :route="route('amd.index')"
            >
                {{ __('Back') }}
            </x-common.button-link>
        </td>
    @else
        <td colspan='9'>
            <x-common.button-link
                styling='outline'
                category='warning'
                :route="route('amd.create')"
            >
                {{ __('New SKU') }}
            </x-common.button-link>
        </td>
    @endif
</tr>
</tfoot>
