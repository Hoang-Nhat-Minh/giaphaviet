@extends('pages.Auth.main')
@section('content')
  <section>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        <img class="w-36 h-auto mr-2" src="{{ asset('assets/images/logo.png') }}" alt="logo">
      </a>
      <div
        class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-grey-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            {{ __('Register') }}
          </h1>

          <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="flex flex-col">
              <div class="md:flex md:flex-row md:space-x-6 space-y-4 md:space-y-0" style="margin-bottom:15px">
                <div>
                  <label for="name"
                    class="block text-start mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Full Name') }}</label>
                  @if ($errors->has('name'))
                    <input type="text" name="name" id="name"
                      class="bg-gray-50 border border-red-500 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-red-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ $errors->first('name') }}">
                  @else
                    <input type="text" name="name" id="name"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ __('Full Name') }}" value="{{ old('name') }}">
                  @endif
                </div>

                <div>
                  <label for="email"
                    class="block text-start mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                  @if ($errors->has('email'))
                    <input type="email" name="email" id="email"
                      class="bg-gray-50 border border-red-500 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-red-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ $errors->first('email') }}">
                  @else
                    <input type="email" name="email" id="email"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="Email" value="{{ old('email') }}">
                  @endif
                </div>
              </div>

              <div class="md:flex md:flex-row md:space-x-6 space-y-4 md:space-y-0" style="margin-bottom:15px">
                <div>
                  <label for="phone"
                    class="block text-start mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Phone number') }}</label>
                  @if ($errors->has('phone'))
                    <input type="text" name="phone" id="phone"
                      class="bg-gray-50 border border-red-500 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-red-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ $errors->first('phone') }}">
                  @else
                    <input type="text" name="phone" id="phone"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ __('Phone number') }}" value="{{ old('phone') }}">
                  @endif
                </div>

                <div>
                  <label for="lineages"
                    class="block text-start mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Lineages') }}</label>
                  @if ($errors->has('lineages'))
                    <input type="text" name="lineages" id="lineages"
                      class="bg-gray-50 border border-red-500 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-red-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ $errors->first('lineages') }}">
                  @else
                    <input type="text" name="lineages" id="lineages"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ __('Lineages') }}" value="{{ old('lineages') }}">
                  @endif
                </div>
              </div>

              <div class="md:flex md:flex-row md:space-x-6 space-y-4 md:space-y-0" style="margin-bottom:15px">
                <div>
                  <label for="branches"
                    class="block text-start mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Branches') }}</label>
                  @if ($errors->has('branches'))
                    <input type="text" name="branches" id="branches"
                      class="bg-gray-50 border border-red-500 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-red-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ $errors->first('branches') }}">
                  @else
                    <input type="text" name="branches" id="branches"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ __('Branches') }}" value="{{ old('branches') }}">
                  @endif
                </div>

                <div>
                  <label for="location"
                    class="block text-start mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Address') }}</label>
                  @if ($errors->has('location'))
                    <input type="text" name="location" id="location"
                      class="bg-gray-50 border border-red-500 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-red-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ $errors->first('location') }}">
                  @else
                    <input type="text" name="location" id="location"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ __('Address') }}" value="{{ old('location') }}">
                  @endif
                </div>
              </div>

              <div class="md:flex md:flex-row md:space-x-6 space-y-4 md:space-y-0">
                <div>
                  <label for="password"
                    class="block text-start mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Password') }}</label>
                  @if ($errors->has('password'))
                    <input type="password" name="password" id="password"
                      class="bg-gray-50 border border-red-500 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-red-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ $errors->first('password') }}">
                  @else
                    <input type="password" name="password" id="password"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ __('Password') }}">
                  @endif
                </div>

                <div>
                  <label for="rewrite"
                    class="block text-start mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Re-Enter Password') }}</label>
                  @if ($errors->has('rewrite'))
                    <input type="password" name="rewrite" id="rewrite"
                      class="bg-gray-50 border border-red-500 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-red-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ $errors->first('rewrite') }}">
                  @else
                    <input type="password" name="rewrite" id="rewrite"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="{{ __('Re-Enter Password') }}">
                  @endif
                </div>
              </div>
            </div>

            <button type="submit"
              class="w-full mt-5 mx-auto text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 p-3">{{ __('Register') }}</button>
          </form>
        </div>
      </div>
  </section>
@endsection
