<script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.site_key') }}"></script>

<div x-data="contactUs" class="contact-us section" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6  align-self-center">
                <div class="section-heading">
                    <h6>Contact Us</h6>
                    <h2>Feel free to contact us anytime</h2>
                    <p>Thank you for choosing our templates. We provide you best CSS templates at absolutely 100%
                        free of charge. You may support us by sharing our website to your friends.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-us-content">
                    <form id="contact-form" action="" method="post" @submit.prevent="formSubmit">
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset>
                                    <input type="name" name="name" id="name" placeholder="Ваше имя..."
                                        autocomplete="on" required x-model="name">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                        placeholder="Ваш E-mail..." required="" x-model="email">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <textarea name="message" id="message" placeholder="Ваше сообщение" x-model="message"></textarea>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="orange-button">Отправить
                                        сообщение</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('contactUs', () => ({
            name: '',
            email: '',
            message: '',
            formSubmit() {
                const name = this.name;
                const email = this.email;
                const message = this.message;

                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ config('recaptcha.site_key') }}', {
                        action: 'submit'
                    }).then(function(token) {
                        axios.post("{{ route('contact-us') }}", {
                            "g-recaptcha-response": token,
                            name: name,
                            email: email,
                            message: message
                        }).then(function(response) {
                            console.log(response);
                        });
                    });
                });
                console.log('form submit');
            }
        }))
    })
</script>
