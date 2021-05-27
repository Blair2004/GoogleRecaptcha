@extends( 'layout.dashboard' )

@section( 'layout.dashboard.body' )
<div>
    @include( '../common/dashboard-header' )
    <div class="px-4 flex flex-col" id="dashboard-content">
        <div class="flex-auto flex flex-col">
            <div class="page-inner-header mb-4">
                <h3 class="text-3xl text-gray-800 font-bold">{{ $title ?? __m( 'Unamed Page', 'GoogleRecaptcha' ) }}</h3>
                <p class="text-gray-600">{{ $description ?? __m( 'No Description Provided', 'GoogleRecaptcha' ) }}</p>
            </div>
        </div>
        <div>
            <ns-settings
                url="{{ url( '/api/nexopos/v4/settings/google-recaptcha.settings' ) }}"
                
                >
                <template v-slot:error-form-invalid>{{ __m( 'Unable to proceed the form is not valid.', 'GoogleRecaptcha' ) }}</template>
            </ns-settings>
        </div>
    </div>
</div>
@endsection