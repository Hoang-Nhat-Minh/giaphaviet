document.addEventListener('alpine:init', () => {
    Alpine.data('genealogy', () => ({
        modalNewOpen: false,
        modalEditOpen: false,
        alertMessage: '',
        //attribute edit member
        id: 1,
        name: '',
        parent_id: '',
        parent: '',
        date_of_birth: '',
        date_of_death: '',
        address_old: '',
        address: '',
        image: '',
        status: '',
        level: '',
        job: '',
        
        init() {
        },
        editMember(id) {
            fetch('get-member/' + id)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    this.id = data.id
                    this.parent_id = data.dad ? data.dad.id : '';
                    this.name = data.name
                    this.parent = data.dad ? data.dad.name : '';
                    this.date_of_birth = this.formatDateTime(data.date_of_birth);
                    this.date_of_death = this.formatDateTime(data.date_of_death);
                    this.address_old = data.address_old;
                    this.address = data.address;
                    this.status = data.status;
                    this.image = data.image;
                    this.level = data.level;
                    this.job = data.job;
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });

            this.modalEditOpen = !this.modalEditOpen;
            this.resetZoom();
        },
        addNewParent() {
            fetch('get-member/' + this.id)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // console.log(data)
                    this.parent_id = data.id
                    this.name = '';
                    this.parent = data.name;
                    this.date_of_birth = '';
                    this.date_of_death = '';
                    this.address_old = '';
                    this.address = '';
                    this.status = '';
                    this.image = '';
                    this.level = '';
                    this.job = '';
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });
            this.resetZoom();
            this.modalEditOpen = false;
            this.modalNewOpen = true
        },
        resetZoom() {
            const zoomElement = document.querySelector(".wrapper");

            zoomElement.style.transform = `scale(${this.zoomX},${this.zoomY}) translate(0px, 350px)`;
        },
        formatDateTime(date) {

            // Chuyển đổi chuỗi thành đối tượng Date
            let dateTime = new Date(date);

            // Lấy ngày, tháng và năm từ đối tượng Date
            let year = dateTime.getFullYear();
            let month = String(dateTime.getMonth() + 1).padStart(2, '0'); // Thêm '0' vào đầu nếu cần
            let day = String(dateTime.getDate()).padStart(2, '0'); // Thêm '0' vào đầu nếu cần

            // Tạo chuỗi mới theo định dạng "YYYY-MM-DD"
            let formattedDate = `${year}-${month}-${day}`;

            return formattedDate;
        },
    }))
})