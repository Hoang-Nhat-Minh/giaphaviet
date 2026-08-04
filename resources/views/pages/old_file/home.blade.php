{{-- 
@extends('main')
@section('content')
<style>
   
    .backgrond-left{
        position: absolute;
        left: 1vw;
        top:45vh;
    }
    .backgrond-right{
        position: absolute;
        right: 1vw;
        top:45vh;
    }
    .backgrond-top{
       
        /* height: 250px; */
        width:100%;
        object-fit: cover;
        
    }
    .bft-search{
        right: 30px !important;
    }
    .bft-edit-form{
        z-index: 20;
    } 
    @media only screen and (max-width: 768px) {
            .backgrond-left,
            /* .backgrond-top, */
            .backgrond-right {
                display: none;
            }
            .backgrond-top{
                position: absolute;
                top:0;
                z-index: 20;
            }
        }
    .btn-screen-image{
        position: absolute;
        bottom: 185;
        right: 20;
        background-color: white;
        padding: 4px 4px 4px 4px;
        /* border-radius: 10px; */
        box-shadow: 0px 1px 4px rgba(0,0,0,0.3);
        font-weight: 700;
        color: white;
        z-index: 10;
        border: 1px solid #cacaca
    }
</style>
    <button class="btn-screen-image" onclick="captureScreen()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #818181;transform: ;msFilter:;"><path d="M12 9c-1.626 0-3 1.374-3 3s1.374 3 3 3 3-1.374 3-3-1.374-3-3-3z"></path><path d="M20 5h-2.586l-2.707-2.707A.996.996 0 0 0 14 2h-4a.996.996 0 0 0-.707.293L6.586 5H4c-1.103 0-2 .897-2 2v11c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V7c0-1.103-.897-2-2-2zm-8 12c-2.71 0-5-2.29-5-5s2.29-5 5-5 5 2.29 5 5-2.29 5-5 5z"></path></svg>
    </button>
    <div style="width: 100%" id="tree"></div>
    <script  src="{{ asset('assets/js/orgchart.js') }}"></script>
    <script  src="{{ asset('assets/js/familytree.js') }}"></script>
    <script  src="{{ asset('assets/js/customFamilyTree.js') }}"></script>
    <script>
        
        let dataInit = {!!$branch->data!!};
        var family = new FamilyTree(document.getElementById("tree"), {
            align: OrgChart.align.center,
            enableSearch: false,
            mouseScrool: FamilyTree.action.zoom,
            nodeTreeMenu: true,
            scaleInitial: FamilyTree.match.boundary,
            toolbar: {
                zoom: true,
                fit: true,
                fullScreen: true
            },
            editForm: {
                titleBinding: "name",
                photoBinding: "img",
                generateElementsFromFields: false,
                elements: [{
                        type: 'textbox',
                        label: 'Họ và tên',
                        binding: 'name'
                    },
                    {
                        type: 'textbox',
                        label: 'Hình ảnh',
                        binding: 'img',
                        btn: 'Upload'
                    },
                    {
                        type: 'date',
                        label: 'Ngày sinh',
                        binding: 'date_of_birth'
                    },
                    {
                        type: 'select',
                        label: 'Tình trạng',
                        binding: 'status',
                        options: [
                            {
                                value: 'cs',
                                text: 'Còn sống'
                            },
                            {
                                value: 'dm',
                                text: 'Đã mất'
                            }
                        ]
                    },
                    {
                        type: 'date',
                        label: 'Ngày mất',
                        binding: 'date_of_death'
                    },
                    {
                        type: 'textbox',
                        label: 'Nơi sinh',
                        binding: 'address_old'
                    },
                    {
                        type: 'textbox',
                        label: 'Thường trú',
                        binding: 'address'
                    },
                    {
                        type: 'textbox',
                        label: 'Trình độ học vấn',
                        binding: 'level'
                    },
                    {
                        type: 'textbox',
                        label: 'Công việc hiện tại',
                        binding: 'job'
                    },

                ],
                cancelBtn: 'Đóng',
                saveAndCloseBtn: 'Lưu và thoát',
                addMoreFieldName: 'Tên Trường',
                addMoreBtn: 'Thêm',
                addMore: 'Thêm trường dữ liệu',
                buttons: {
                    edit: {
                        icon: FamilyTree.icon.edit(24, 24, '#fff'),
                        text: 'Edit',
                        hideIfEditMode: true,
                        hideIfDetailsMode: false
                    },
                    share: null,
                    pdf: null,
                }
            },

            template: 'john',
            nodeBinding: {
                field_0: "name",
                field_1: "title",
                img_0: "img",
                status : "status"
            },
            tags: {
                dm: {
                    template: "dm"
                }
            }, 
        });
        family.on('field', function(sender, args){
            var status = args.data["status"];
            if(status == "dm"){
                if (!args.node.tags.includes("dm")) {
                    if (args.node.tags.includes("male")) {
                        let array = args.node.tags.filter(item => item !== "male");
                        args.node.tags = array;
                    }else if(args.node.tags.includes("female")){
                        let array = args.node.tags.filter(item => item !== "female");
                        args.node.tags = array;
                    }
                    args.node.tags.push("dm");
                    args.node.gender = "";
                    args.node.templateName = "dm";
                    // console.log(args.node);
                } 
            }
        });
        family.load(dataInit);
        family.onUpdateNode( async (args) => {
            var data = await dataInit
            fetch('{{ route('branch.update',$branch->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                
            });
        });


        //upload Image
        family.editUI.on('element-btn-click', function(sender, args) {

            FamilyTree.fileUploadDialog(function(file) {
                var data = new FormData();
                data.append('files', file);
                fetch('{{ route('upload.photo') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: data
                    })
                    .then(response => {
                        response.json().then(responseData => {
                            // console.log(responseData);
                            args.input.value = responseData;
                            sender.setAvatar(responseData);
                        });
                    });
            });
        });
        family.draw();
    </script>

   
    
    <script>
        function getWindowHeight() {
            const body = document.body;
            const html = document.documentElement;

            const documentHeight = Math.max(
                body.scrollHeight, body.offsetHeight, 
                html.clientHeight, html.scrollHeight, html.offsetHeight
            );

            const windowHeight = window.innerHeight || html.clientHeight || body.clientHeight;

            return Math.max(documentHeight, windowHeight);
        }
        async function captureScreen(){
           
            try {
                const captureStream = await navigator.mediaDevices.getDisplayMedia({
                    preferCurrentTab:true
                });
                const video = document.createElement("video");
                
                video.addEventListener("loadedmetadata" , () => {
                    const canvas = document.createElement("canvas");
                    const ctx = canvas.getContext('2d');
                    
                    canvas.width = video.videoWidth;
                    canvas.height =  video.videoHeight;

                    video.play();
                    
                    ctx.drawImage(video, 0, 0,canvas.width, canvas.height);
                    captureStream.getVideoTracks()[0].stop();
                     // Tạo ra một URL cho ảnh
                    const imageURL = canvas.toDataURL("image/png");

                    // Tạo một phần tử a để tải ảnh về
                    const link = document.createElement('a');
                    link.href = imageURL;
                    link.download = 'screenshot.png';
                    link.click();
                });
                video.srcObject = captureStream;
            } catch (err) {
                console.error("Error: " + err);
            }
        };
        
    </script>
@endsection --}}
