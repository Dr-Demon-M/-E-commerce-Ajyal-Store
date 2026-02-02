<x-front-layout title="Confirm Password">

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('user.password.confirm') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Secure Area</h3>
                                <p>This is a secure area of the application. Please confirm your password before
                                    continuing.</p>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <div class="form-group input-group">
                                <label for="password">Password</label>
                                <input class="form-control" name="password" type="password" id="password" required
                                    autocomplete="current-password">
                            </div>

                            <div class="button">
                                <button class="btn" type="submit">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
