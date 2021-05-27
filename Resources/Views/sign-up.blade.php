<script src="https://www.google.com/recaptcha/api.js?render={{ $options->get( 'gr_google_site_key' ) }}"></script>
<script>
    nsExtraComponents.grField   =   Vue.component( 'grField', {
        template : `<div class="w-full">
            <div class="py-2 flex items-center w-full rounded-lg bg-blue-100 p-2 anim-duration-500 fade-in-entrance" v-if="validating">
                <ns-spinner size="6" border="2"/>
                <div class="pl-2">
                    <span class="text-gray-700">Validating...</span>
                </div>
            </div>
        </div>`,
        data() {
            return {
                parentInstance: null,
                isValidated: false,
                validating: false,
            }
        },
        mounted() {
            nsHooks.addAction( 'ns-register-mounted', 'google-recaptcha', ( instance ) => {
                this.parentInstance   =   instance;
            });

            nsHooks.addFilter( 'ns-register-submit', 'google-recaptcha', ( proceed ) => {
                if ( ! this.isValidated ) {
                    this.validating     =   true;
                    grecaptcha.ready( () => {
                        grecaptcha.execute( `{{ $options->get( 'gr_google_site_key' ) }}`, { action: 'submit' } ).then( token => {
                            this.isValidated    =   true;

                            this.parentInstance.fields.forEach( field => {
                                if ( field.name === 'grField' ) {
                                    field.value     =   token;
                                }
                            });

                            this.validating     =   false;
                            this.parentInstance.register();
                        })
                    });
                    return false;
                }
                return proceed;
            });
        }
    });
</script>