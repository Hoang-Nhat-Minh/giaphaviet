{{-- @extends('pages.main')
@section('content')
  <section class="" x-data="lineage">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        <img class="w-36 h-auto mr-2" src="{{ asset('assets/images/logo.png') }}" alt="logo">
      </a>
      <div
        class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Chọn Chi Họ
          </h1>
          <form class="space-y-4 md:space-y-6" action="#">

            <div>
              <label for="email" class="block text-start mb-2 text-sm font-medium text-gray-900 dark:text-white">Dòng
                họ:</label>
              <select name="" id="" x-on:change="selectOption($el.value)"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-50">

                <option value="">--Chọn--</option>
                <template x-for="(item, index) in lineage" :key="index">
                  <option :value="item.id" x-text="item.name"></option>
                </template>
              </select>
            </div>

            <template x-if="branch">
              <div>
                <label for="email" class="block text-start mb-2 text-sm font-medium text-gray-900 dark:text-white">Chi
                  họ:</label>
                <select name="" x-on:change="selectOptionBranch($el.value)" id=""
                  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-50">
                  <option value="">--Chọn--</option>
                  <template x-for="(item, index) in branchs" :key="index">
                    <option :value="item.id" x-text="item.name"></option>
                  </template>
                </select>
              </div>
            </template>


            <div>
              <a :href="getUrl()"
                class="w-full !text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Xem
                chi tiết</a>

            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('lineage', () => ({
        lineage: [],
        branchs: [],
        branch: false,
        idBranch: '',
        init() {
          this.lineage = {!! $lineage !!}


        },
        selectOption(_id) {
          this.branch = true

          let results = this.lineage.find(({
            id
          }) => id === parseInt(_id))
          this.branchs = results.branch;
        },
        selectOptionBranch(id) {
          this.idBranch = id
          console.log(this.idBranch)
        },
        getUrl() {
          if (this.idBranch === '') {
            return '#'
          } else {
            return `{{ Request::root() }}/branch/${this.idBranch}`
          }

        }

      }))
    })
  </script>
@endsection --}}
