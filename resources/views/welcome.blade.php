    <div class="hero min-h-[calc(100vh-16rem)]">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-3xl font-bold text-center mb-6">Create Account</h1>

                    <form method="POST" action="{{ route('user.store') }}" class="needs-validation">
                        @csrf
                        <!-- Email -->
                        <label class="floating-label mb-6">
                            <input type="text"
                                   name="nome"
                                   placeholder="John Doe"
                                   value="{{ old('nome') }}"
                                   class="input input-bordered @error('nome') input-error @enderror"
                                   required>
                            <span>Nome</span>
                        </label>
                        @error('nome')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                        <label class="floating-label mb-6">
                            <input type="email"
                                   name="email"
                                   placeholder="[mail@example.com](<mailto:mail@example.com>)"
                                   value="{{ old('email') }}"
                                   class="input input-bordered @error('email') input-error @enderror"
                                   required>
                            <span>Email</span>
                        </label>
                        @error('email')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Password -->
                        <label class="floating-label mb-6">
                            <input type="password"
                                   name="password"
                                   placeholder="••••••••"
                                   class="input input-bordered @error('password') input-error @enderror"
                                   required>
                            <span>Password</span>
                        </label>
                        @error('password')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                        <label class="floating-label mb-6">
                            <input type="number"
                                   name="tipo"
                                   placeholder="1"
                                   value="{{ old('tipo') }}"
                                   class="input input-bordered @error('tipo') input-error @enderror"
                                   required>
                            <span>Tipo</span>
                        </label>
                        @error('tipo')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                        <label class="floating-label mb-6">
                            <input type="text"
                                   name="telefone"
                                   placeholder="John Doe"
                                   value="{{ old('telefone') }}"
                                   class="input input-bordered @error('telefone') input-error @enderror"
                                   required>
                            <span>Telefone</span>
                        </label>
                        @error('telefone')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                        <label class="floating-label mb-6">
                            <input type="text"
                                   name="endereco"
                                   placeholder="John Doe"
                                   value="{{ old('endereco') }}"
                                   class="input input-bordered @error('endereco') input-error @enderror"
                                   required>
                            <span>Endereço</span>
                        </label>
                        @error('endereco')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Password Confirmation -->
                       

                        <!-- Submit Button -->
                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Register
                            </button>
                        </div>
                    </form>

                    <div class="divider">OR</div>
                    <p class="text-center text-sm">
                        Already have an account?
                        <a href="/login" class="link link-primary">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
