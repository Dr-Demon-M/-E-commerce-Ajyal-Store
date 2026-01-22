            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <x-form.input value="{{ old('name', $admin->name) }}" name="name" type="text"
                            placeholder="Enter admin name..." label="Admin Name"
                            class="form-control form-control-lg bg-light shadow-none" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <x-form.input value="{{ old('email', $admin->email) }}" name="email" type="email"
                            placeholder="Enter admin email..." label="Admin Email"
                            class="form-control form-control-lg bg-light shadow-none" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <x-form.input value="{{ old('username', $admin->username) }}" name="username" type="text"
                            placeholder="Enter username..." label="Username"
                            class="form-control form-control-lg bg-light shadow-none" />
                    </div>

                    <div class="col-md-6 mb-4">
                        @if (!$admin->password)
                            <x-form.input name="password" type="password" placeholder="Enter password..."
                                label="Password" class="form-control form-control-lg bg-light shadow-none" />
                        @else
                            <x-form.input disabled name="password" type="password" placeholder="**********"
                                label="Password" class="form-control form-control-lg bg-light shadow-none" />
                        @endif
                    </div>

                    <div class="col-md-12 mb-4">
                        <x-form.input value="{{ old('phone_number', $admin->phone_number) }}" name="phone_number"
                            type="text" placeholder="Enter phone number..." label="Phone Number"
                            class="form-control form-control-lg bg-light shadow-none" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <x-form.select name="store_id" label="Store" :selected="$admin->store_id" :options="$stores" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Admin Status</label>
                        <select name="status" class="form-control form-control-lg  bg-light shadow-none">
                            <option value="" selected disabled>Choose status...</option>
                            <option value="active" @selected(old('status', $admin->status) == 'active')>Active</option>
                            <option value="inactive" @selected(old('status', $admin->status) == 'inactive')>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Admin Status</label>
                        <select name="super_admin" class="form-control form-control-lg  bg-light shadow-none">
                            <option value="" selected disabled>Choose status...</option>
                            <option value="1" @selected(old('super_admin', $admin->super_admin) == '1')>Super Admin</option>
                            <option value="0" @selected(old('super_admin', $admin->super_admin) == '0')>Normal Admin</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white border-top-0 p-4">
                <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm rounded-pill">
                    <i class="fas fa-check-circle mr-2"></i> {{ $button ?? 'Save Changes' }}
                </button>
                <a href="{{ route('admins.index') }}" class="btn btn-link text-muted fw-bold ml-2">Cancel</a>
            </div>
