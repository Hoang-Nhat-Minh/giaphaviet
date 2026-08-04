@extends('screens.layouts.' . $template)
@section('main')
    @include('screens.elements.comment')

    <style>
        .background-left {
            position: absolute;
            left: 1vw;
            top: 45vh;
        }

        .background-right {
            position: absolute;
            right: 1vw;
            top: 45vh;
        }

        .background-top {

            /* height: 250px; */
            width: 100%;
            object-fit: cover;

        }

        .bft-search {
            right: 30px !important;
        }

        .bft-edit-form {
            z-index: 20;
        }

        @media only screen and (max-width: 768px) {

            .background-left,
            /* .background-top, */
            .background-right {
                display: none;
            }

            .background-top {
                position: absolute;
                top: 0;
                z-index: 20;
            }
        }

        .btn-screen-image {
            position: absolute;
            bottom: 185;
            right: 20;
            background-color: white;
            padding: 4px 4px 4px 4px;
            /* border-radius: 10px; */
            box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.3);
            font-weight: 700;
            color: white;
            z-index: 10;
            border: 1px solid #cacaca
        }
    </style>
    {{-- <button class="btn-screen-image" onclick="captureScreen()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #818181;transform: ;msFilter:;"><path d="M12 9c-1.626 0-3 1.374-3 3s1.374 3 3 3 3-1.374 3-3-1.374-3-3-3z"></path><path d="M20 5h-2.586l-2.707-2.707A.996.996 0 0 0 14 2h-4a.996.996 0 0 0-.707.293L6.586 5H4c-1.103 0-2 .897-2 2v11c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V7c0-1.103-.897-2-2-2zm-8 12c-2.71 0-5-2.29-5-5s2.29-5 5-5 5 2.29 5 5-2.29 5-5 5z"></path></svg>
    </button> --}}
    @if (empty(Auth::user()->loai_dich_vu))
        <div
            style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; background: #fff3cd; color: #856404; padding: 10px 24px; border-radius: 30px; border: 1px solid #ffeeba; box-shadow: 0 4px 15px rgba(0,0,0,0.1); font-weight: 600; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-exclamation-triangle"></i>
            <span>Tài khoản chưa đăng ký gói dịch vụ. Gia phả đang ở chế độ <strong>Chỉ đọc (Read-only)</strong>.</span>
        </div>
    @endif

    <div style="width: 100%;height: 100vh;" id="tree"></div>
    <script>
        var template = {{ Auth::user()->template }};
    </script>

    <script src="{{ asset('assets/js/orgchart.js') }}"></script>
    <script src="{{ asset('assets/js/familytree.js') }}"></script>
    <script src="{{ asset('assets/js/customFamilyTree.js') }}"></script>
    <script>
        // if (typeof FamilyTree !== 'undefined') {
        //   FamilyTree.MAX_NODES_MESS = "Tài khoản này hiện đang quá tải thành viên, hãy liên hệ quản trị viên để sửa lỗi";
        // }
        // if (typeof OrgChart !== 'undefined') {
        //   OrgChart.MAX_NODES_MESS = "Tài khoản này hiện đang quá tải thành viên, hãy liên hệ quản trị viên để sửa lỗi";
        // }

        FamilyTree.elements.CustomTextArea = function(data, editElement, minWidth, readOnly) {
            var id = FamilyTree.elements.generateId();
            var value = data[editElement.binding];
            if (value == undefined) value = '';
            if (readOnly && !value) {
                return {
                    html: ''
                };
            }
            var rOnlyAttr = readOnly ? 'readonly' : '';
            var rDisabledAttr = readOnly ? 'disabled' : '';
            return {
                html: `<label for="${id}" style="width:100%;padding-left:10px;color:rgb(175,175,175)">${editElement.label}</label>
                      <textarea ${rDisabledAttr} ${rOnlyAttr} id="${id}" name="${id}" style="width: 100%;height: 200px;margin-left:3px;margin-bottom:5px;border-color:rgb(199,199,199);border-radius:5px" data-binding="${editElement.binding}">${value}</textarea>`,
                id: id,
                value: value
            };
        };

        let dataInit = {!! $branch->data !!};
        var isReadOnly = {{ empty(Auth::user()->loai_dich_vu) ? 'true' : 'false' }};

        var family = new FamilyTree(document.getElementById("tree"), {
            readOnly: isReadOnly,
            align: OrgChart.align.center,
            enableSearch: true,
            searchFields: ["name"],
            mouseScrool: FamilyTree.action.ctrlZoom,
            nodeTreeMenu: !isReadOnly,
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
                        label: 'Chức vụ trong gia đình',
                        binding: 'house'
                    },
                    {
                        type: 'textbox',
                        label: 'Đời thứ',
                        binding: 'generation'
                    },
                    [{
                            type: 'checkbox',
                            label: 'Là trưởng họ',
                            binding: 'head_of_the_clan'
                        },
                        {
                            type: 'checkbox',
                            label: 'Là trưởng chi',
                            binding: 'branch_head'
                        },
                    ],
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
                        options: [{
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
                        label: 'Nghề nghiệp',
                        binding: 'job'
                    },
                    {
                        type: 'textbox',
                        label: 'Vị trí xã hội',
                        binding: 'position'
                    },
                    {
                        type: 'CustomTextArea',
                        label: 'Thành tựu',
                        binding: 'achievement'
                    },
                    {
                        type: 'textbox',
                        label: 'Nơi an táng (Nếu đã mất)',
                        binding: 'cementary'
                    },
                    {
                        type: 'textbox',
                        label: 'Vị trí an táng (Nếu đã mất)',
                        binding: 'cementary_address'
                    },
                ],
                cancelBtn: 'Đóng',
                saveAndCloseBtn: 'Lưu và thoát',
                addMore: null,
                buttons: {
                    edit: {
                        icon: FamilyTree.icon.edit(24, 24, '#fff'),
                        text: 'Sửa thông tin thành viên',
                        hideIfEditMode: true,
                        hideIfDetailsMode: false
                    },
                    remove: {
                        text: 'Xóa thành viên này(Lưu ý không có hoàn tác)'
                    },
                    share: null,
                    pdf: null,
                }
            },

            template: 'john',
            nodeBinding: {
                name: "name",
                img_0: "img",
                status: "status",
                head_of_the_clan: "head_of_the_clan",
                branch_head: "branch_head",
                generation: "generation"
            },

            tags: {
                dm: {
                    template: "dm"
                },
            },
        });

        family.on('field', function(sender, args) {
            var status = args.data["status"];
            var head_of_the_clan = args.data["head_of_the_clan"];
            var branch_head = args.data["branch_head"];
            if (status == "dm") {
                if (!args.node.tags.includes("dm")) {
                    if (args.node.tags.includes("male")) {
                        let array = args.node.tags.filter(item => item !== "male");
                        args.node.tags = array;
                    } else if (args.node.tags.includes("female")) {
                        let array = args.node.tags.filter(item => item !== "female");
                        args.node.tags = array;
                    }
                    args.node.tags.push("dm");
                    args.node.gender = "";
                    args.node.templateName = "dm";
                }
            } else {
                if (head_of_the_clan) {
                    if (args.node.tags.includes("male") && !args.node.tags.includes("head_of_the_clan_male")) {
                        args.node.tags.push("head_of_the_clan_male");
                        args.node.templateName = "head_of_the_clan_male";
                    } else if (args.node.tags.includes("female") && !args.node.tags.includes(
                            "head_of_the_clan_female")) {
                        args.node.tags.push("head_of_the_clan_female");
                        args.node.templateName = "head_of_the_clan_female";
                    }
                }
                if (branch_head) {
                    if (args.node.tags.includes("male") && !args.node.tags.includes("branch_head_male")) {
                        args.node.tags.push("branch_head_male");
                        args.node.templateName = "branch_head_male";
                    } else if (args.node.tags.includes("female") && !args.node.tags.includes(
                            "branch_head_female")) {
                        args.node.tags.push("branch_head_female");
                        args.node.templateName = "branch_head_female";
                    }
                }
            }
        });

        family.load(dataInit);
        family.onUpdateNode(async (args) => {
            if (isReadOnly) {
                alert("Tài khoản của bạn chưa đăng ký gói dịch vụ nào nên không thể thay đổi dữ liệu gia phả.");
                window.location.reload();
                return false;
            }
            var data = await dataInit
            fetch('{{ route('branch.update', $branch->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                .then(async response => {
                    if (!response.ok) { // If the response fails
                        const errorData = await response.json().catch(() => ({}));
                        alert(errorData.message ||
                            "Bạn đã đạt tối đa thành viên, hãy nâng cấp tài khoản.");
                        window.location.reload();
                    }
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
        async function captureScreen() {

            try {
                const captureStream = await navigator.mediaDevices.getDisplayMedia({
                    preferCurrentTab: true
                });
                const video = document.createElement("video");

                video.addEventListener("loadedmetadata", () => {
                    const canvas = document.createElement("canvas");
                    const ctx = canvas.getContext('2d');

                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;

                    video.play();

                    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
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
@endsection
