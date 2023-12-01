@extends('client.layouts.app')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Thông tin người dùng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('client') }}">Trang chủ</a>
                            <span>Thông tin người dùng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(Auth::check())
        <section class="checkout spad">
            <div class="container">
                <div class="checkout__form">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                    here</a> to enter your code</h6>
                            <h6 class="checkout__title">Cập nhật thông tin người dùng</h6>
                            <form action="{{ route('profile.update-user',['id' => $user->id]) }} }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Name</p>
                                            <input name="name" value="{{ $user->name }}" type="text">
                                            @error('name') <span style="color: red;" class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Phone</p>
                                            <input name="phone" value="{{ $user->phone }}" type="tel">
                                            @error('phone') <span style="color: red;" class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    @if($user->image == 'NULL')
                                        <div class="d-flex justify-content-center mb-4">
                                            <img src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg"
                                                 class="rounded-circle" alt="example placeholder" style="width: 100px;" />
                                        </div>
                                    @endif
                                        <div class="d-flex justify-content-center mb-4">
                                            <img src="{{ asset('storage/' . $user->image) }}"
                                                 class="rounded-circle" alt="example placeholder" style="width: 100px;" />
                                        </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn btn-primary btn-rounded">
                                            <label class="form-label text-white m-1" for="customFile1">Choose file</label>
                                            <input name="image" type="file" class="form-control d-none" id="customFile1" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="site-btn">Lưu thông tin</button>
                                </div>
                            </form>

                            <br>
                            <h6 class="checkout__title">Cập nhật thông tin người dùng</h6>
                            <form action="{{ route('profile.update-password-user',['id' => $user->id]) }} }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="checkout__input">
                                    <label for="password_old">Mật khẩu cũ:</label>
                                    <input type="password" id="current_password" name="current_password">
                                </div>

                                <div class="checkout__input">
                                    <label for="new_password">Mật khẩu mới:</label>
                                    <input name="password" type="password" id="password">
                                </div>
{{--                                <div class="checkout__input">--}}
{{--                                    <label for="new_password_confirmation">Xác nhận mật khẩu mới:</label>--}}
{{--                                    <input type="password" id="password" name="new_password_confirmation">--}}
{{--                                </div>--}}
                                <div>
                                    <button type="submit" class="site-btn">Đổi mật khẩu</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Thông tin tài khoản</h4>
                                <div class="checkout__order__products">
                                    <div class="d-flex justify-content-center mb-4">
                                        <img src="{{ asset('storage/' . $user->image) }}"
                                             class="rounded-circle" alt="example placeholder" style="width: 150px;" />
                                    </div>
                                </div>
                                <ul class="checkout__total__all">
                                    <li>Tên khách hàng <span>{{ Auth::user()->name }}</span></li>
                                    <li>Email <span>{{ Auth::user()->email }}</span></li>
                                    <li>Số điện thoại <span>{{ Auth::user()->phone }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('scripts')
    <script>
        const password = document.getElementById('password')
        const showHidePwd = document.getElementById('showHidePassword')

        showHidePwd.onclick = () => {
            showHidePassword()
        }

        const showHidePassword = () => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            showHidePwd.textContent = (type === 'password') ? 'Show password' : 'Hide password';
        }
    </script>
@endsection




