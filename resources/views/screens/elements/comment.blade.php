{{-- Chu thich --}}
<aside class="position-relative" style="z-index: 3">
  <!-- Desktop view -->
  <div class="d-none d-md-block position-absolute top-0 start-0 mt-3 ms-3 bg-light p-2 rounded-3">
    <ul class="p-0">
      <table class="table m-0 p-0">
        <thead>
          <tr>
            <th style="white-space: nowrap; width: fit-content;">{{ __('Symbol') }}</th>
            <th style="white-space: nowrap; width: fit-content;">{{ __('Note') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/head_of_the_clan.png') }}" alt="{{ __('Clan Leader') }}"
                height="30" width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Clan Leader') }}</td>
          </tr>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/branch_head.png') }}" alt="{{ __('Branch Leader') }}"
                height="30" width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Branch Leader') }}</td>
          </tr>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/plus-circle.png') }}" alt="{{ __('Add Member') }}" height="30"
                width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Add Member') }}</td>
          </tr>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/flower.png') }}" alt="{{ __('Deceased Member') }}"
                height="30" width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Deceased Member') }}</td>
          </tr>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/edit.png') }}" alt="{{ __('Edit Member Info') }}"
                height="30" width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Edit Member Info') }}</td>
          </tr>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/remove.png') }}" alt="{{ __('Remove Member') }}" height="30"
                width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Remove Member') }}</td>
          </tr>
        </tbody>
      </table>
    </ul>
  </div>

  <!-- Mobile view -->
  <div class="d-md-none dropup position-fixed bottom-0 start-0 ms-3 mb-3">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
      aria-expanded="false">
      {{ __('Note') }}
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <table class="table m-0 p-0">
        <thead>
          <tr>
            <th style="white-space: nowrap; width: fit-content;">{{ __('Symbol') }}</th>
            <th style="white-space: nowrap; width: fit-content;">{{ __('Note') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/head_of_the_clan.png') }}" alt="{{ __('Clan Leader') }}"
                height="30" width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Clan Leader') }}</td>
          </tr>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/branch_head.png') }}" alt="{{ __('Branch Leader') }}"
                height="30" width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Branch Leader') }}</td>
          </tr>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/plus-circle.png') }}" alt="{{ __('Add Member') }}"
                height="30" width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Add Member') }}</td>
          </tr>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/flower.png') }}" alt="{{ __('Deceased Member') }}"
                height="30" width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Deceased Member') }}</td>
          </tr>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/edit.png') }}" alt="{{ __('Edit Member Info') }}"
                height="30" width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Edit Member Info') }}</td>
          </tr>
          <tr>
            <td style="white-space: nowrap; width: fit-content; text-align: center;">
              <img src="{{ asset('assets/images/custom/remove.png') }}" alt="{{ __('Remove Member') }}" height="30"
                width="30">
            </td>
            <td style="white-space: nowrap; width: fit-content;">{{ __('Remove Member') }}</td>
          </tr>
        </tbody>
      </table>
    </ul>
  </div>
</aside>
{{-- Het Chu Thich --}}
