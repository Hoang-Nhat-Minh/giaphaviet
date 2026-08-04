<!-- Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notificationModalLabel">Thông báo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeButton"></button>
      </div>
      <div class="modal-body">
        @php
          $notifications = session('notifications', []);
        @endphp
        @if (!empty($notifications))
          @foreach ($notifications as $notification)
            <div class="mb-3">
              <strong>{{ $notification->name }}</strong> <br>
              <small>{{ \Carbon\Carbon::parse($notification->datetime)->format('d M, Y') }}</small> <br>
              <p>
                @php
                  $daysRemaining = \Carbon\Carbon::now()->diffInDays(
                      \Carbon\Carbon::parse($notification->datetime),
                      false,
                  );
                @endphp
                @if ($daysRemaining === 0)
                  Hôm nay là ngày {{ $notification->name }}.
                @else
                  Còn {{ $daysRemaining }} ngày nữa là đến {{ $notification->name }}.
                @endif
              </p>
            </div>
          @endforeach
        @else
          <p>Không có thông báo nào.</p>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeButtonFooter">Đóng</button>
        <button type="button" class="btn btn-danger" id="noShowAgainButton">Không hiển thị lại</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    @if (!empty($notifications))
      var notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
      notificationModal.show();
    @endif

    // Thêm sự kiện cho nút "Không hiển thị lại"
    document.getElementById('noShowAgainButton').addEventListener('click', function() {
      // Gửi yêu cầu đến route để xóa thông báo khỏi session
      fetch('{{ route('remove.notifications') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          action: 'forget'
        })
      }).then(response => {
        if (response.ok) {
          // Đóng modal sau khi xóa thông báo
          notificationModal.hide();
        }
      });
    });

    // Thêm sự kiện cho các nút đóng khác
    var closeButtons = document.querySelectorAll('#closeButton, #closeButtonFooter');
    closeButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        notificationModal.hide();
      });
    });
  });
</script>
