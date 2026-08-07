<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xuất PDF Cây Gia Phả - Giáp Hả Việt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body,
        html {
            width: 100%;
            height: 100%;
            background-color: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            overflow-x: auto;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .export-toolbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 99999;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            gap: 16px;
        }

        .export-toolbar .title-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .export-toolbar .title-box i {
            font-size: 24px;
            color: #b02522;
        }

        .export-toolbar h1 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
        }

        .export-toolbar .sub-title {
            font-size: 0.8rem;
            color: #64748b;
        }

        .export-toolbar .action-btns {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Bộ nút ẩn/hiện trang trí Header / Footer */
        .decor-toggles {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f1f5f9;
            padding: 6px 14px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }

        .toggle-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
            user-select: none;
        }

        .toggle-btn input[type="checkbox"] {
            accent-color: #b02522;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .btn-print-pdf {
            background: linear-gradient(135deg, #b02522 0%, #8e1c19 100%);
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(176, 37, 34, 0.25);
            transition: all 0.2s ease;
        }

        .btn-print-pdf:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(176, 37, 34, 0.35);
        }

        .btn-export-svg {
            background: #ffffff;
            color: #1e293b;
            border: 1px solid #cbd5e1;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-export-svg:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        /* Thống nhất khu vực in gia phả */
        #pdf-print-area {
            width: 100%;
            margin-top: 65px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        /* Khung hiển thị cây gia phả (Container show tree) chứa nền bggiapha2.jpg */
        #tree-container {
            width: 100%;
            height: calc(100vh - 65px);
            position: relative;
            background-image: url('{{ asset('assets/images/bggiapha2.jpg') }}');
            background-size: cover;
            background-position: center;
            box-sizing: border-box;
        }

        #tree {
            width: 100%;
            height: 100%;
        }

        /* Header trang trí: Nằm bên trong #tree-container, Position Absolute & Căn giữa phía trên */
        .decor-header-box {
            position: absolute;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            pointer-events: none;
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }

        .bg-header-img {
            max-height: 200px;
            width: auto;
            max-width: 90%;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        /* Footer trang trí: Nằm bên trong #tree-container, Position Absolute & Căn giữa phía dưới */
        .decor-footer-box {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            pointer-events: none;
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }

        .bg-footer-img {
            width: 300px;
            max-width: 80%;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        /* Ẩn hoàn toàn các UI không cần thiết của FamilyTreeJS */
        .bft-edit-form,
        .bft-search,
        .bft-toolbar,
        .bft-control {
            display: none !important;
        }

        /* CSS dành riêng cho chế độ In / Xuất PDF (Print Media Query) */
        @media print {

            .no-print,
            .export-toolbar {
                display: none !important;
            }

            body,
            html {
                background: #ffffff !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                height: 100% !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            #pdf-print-area {
                margin-top: 0 !important;
                width: 100% !important;
                position: relative !important;
            }

            #tree-container {
                height: auto !important;
                min-height: 100vh !important;
                width: 100% !important;
                position: relative !important;
                background-image: url('{{ asset('assets/images/bggiapha2.jpg') }}') !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .decor-header-box {
                position: absolute !important;
                top: 15px !important;
                left: 50% !important;
                transform: translateX(-50%) !important;
                z-index: 100 !important;
                width: 100% !important;
                text-align: center !important;
                background: transparent !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .decor-footer-box {
                position: absolute !important;
                bottom: 15px !important;
                left: 50% !important;
                transform: translateX(-50%) !important;
                z-index: 100 !important;
                width: 100% !important;
                text-align: center !important;
                background: transparent !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            #tree {
                width: 100% !important;
                height: 100% !important;
            }
        }
    </style>
</head>

<body>

    <!-- Thanh công cụ điều khiển -->
    <div class="export-toolbar no-print">
        <div class="title-box">
            <i class="fa fa-file-pdf-o"></i>
            <div>
                <h1>Xuất File PDF Gia Phả - Bản In Khổ Lớn</h1>
                <div class="sub-title">Tự động giữ nguyên bố cục Vector nét cao cho nhà in (A0, A1, A2...)</div>
            </div>
        </div>

        <div class="action-btns">
            <!-- Nút bật tắt hiển thị Header và Footer -->
            <div class="decor-toggles">
                <label class="toggle-btn" title="Ẩn / Hiện hình ảnh Header ở phía trên cây gia phả">
                    <input type="checkbox" id="chk-header" onchange="toggleHeader(this.checked)">
                    <i class="fa fa-image"></i> Ảnh Header
                </label>
                <label class="toggle-btn" title="Ẩn / Hiện hình ảnh Footer ở phía dưới cây gia phả">
                    <input type="checkbox" id="chk-footer" onchange="toggleFooter(this.checked)">
                    <i class="fa fa-picture-o"></i> Ảnh Footer
                </label>
            </div>

            <button type="button" class="btn-export-svg" onclick="downloadSvg()">
                <i class="fa fa-download"></i> Tải File SVG Nét
            </button>
            <button type="button" class="btn-print-pdf" onclick="triggerPdfPrint()">
                <i class="fa fa-print"></i> In / Xuất PDF Vector (Ctrl + P)
            </button>
        </div>
    </div>

    <!-- Khu vực In Gia Phả: Header và Footer đều đè absolute bên trong #tree-container -->
    <div id="pdf-print-area">

        <!-- Khung Cây Gia Phả (Container show tree) chứa nền bggiapha2.jpg -->
        <div id="tree-container">
            
            <!-- Hình ảnh Header (bg-header.png) nằm TRONG #tree-container với position: absolute & căn giữa phía trên -->
            <div id="pdf-header-container" class="decor-header-box" style="display: none;">
                <img src="{{ asset('assets/images/bg-header.png') }}" class="bg-header-img" alt="Header Gia Phả">
            </div>

            <div id="tree"></div>

            <!-- Hình ảnh Footer (bggiaphaft.png) nằm TRONG #tree-container với position: absolute & căn giữa phía dưới -->
            <div id="pdf-footer-container" class="decor-footer-box" style="display: none;">
                <img src="{{ asset('assets/images/bggiaphaft.png') }}" class="bg-footer-img" alt="Footer Gia Phả">
            </div>
        </div>

    </div>

    <script>
        var template = "{{ $template }}";
    </script>
    <script src="{{ asset('assets/js/orgchart.js') }}"></script>
    <script src="{{ asset('assets/js/familytree.js') }}"></script>
    <script src="{{ asset('assets/js/customFamilyTree.js') }}"></script>

    <script>
        FamilyTree.elements.CustomTextArea = function(data, editElement, minWidth, readOnly) {
            var id = FamilyTree.elements.generateId();
            var value = data[editElement.binding] || '';
            return {
                html: ''
            };
        };

        let dataInit = {!! $branch->data !!};

        var family = new FamilyTree(document.getElementById("tree"), {
            readOnly: true,
            align: OrgChart.align.center,
            enableSearch: false,
            mouseScrool: FamilyTree.action.ctrlZoom,
            nodeTreeMenu: false,
            scaleInitial: FamilyTree.match.boundary,
            toolbar: false,
            editForm: false,
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

        // Hàm Ẩn / Hiện hình ảnh Header
        function toggleHeader(show) {
            var headerEl = document.getElementById('pdf-header-container');
            if (headerEl) {
                headerEl.style.display = show ? 'block' : 'none';
            }
        }

        // Hàm Ẩn / Hiện hình ảnh Footer
        function toggleFooter(show) {
            var footerEl = document.getElementById('pdf-footer-container');
            if (footerEl) {
                footerEl.style.display = show ? 'block' : 'none';
            }
        }

        function triggerPdfPrint() {
            window.print();
        }

        function downloadSvg() {
            if (typeof family.exportSVG === 'function') {
                family.exportSVG({
                    filename: 'GiaPha_Vector_InAn.svg',
                    expand: true
                });
            } else {
                alert('Tải chuỗi SVG không khả dụng.');
            }
        }

        // Nếu có tham số autoprint=1, tự động bật hộp thoại in
        window.addEventListener('load', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('autoprint') === '1') {
                setTimeout(function() {
                    window.print();
                }, 1200);
            }
        });
    </script>
</body>

</html>
