<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kỹ thuật trồng hoa triều chuông - Vườn Sài Gòn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
    /* ================================================= */
    /* THIẾT LẬP CHUNG VÀ BIẾN MÀU */
    /* ================================================= */
    :root {
        --primary-green: #1A5D2E;
        --banner-title-green: #B7FF5A;
        --toc-green: #449D47;
        --vsg-red: #C52928;

        --header-total-height: 90px;
        --banner-height: 600px;
    }

    body {
        margin: 0;
        padding: 0;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    /* ================================================= */
    /* HEADER CỐ ĐỊNH (Luôn nằm trên cùng) */
    /* ================================================= */
    .header-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: var(--header-height);
        z-index: 9000;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .header-top {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .header-main {
        padding: 0;
        border-bottom: 1px solid #eee;
    }

    .logo-text {
        color: var(--primary-green);
        font-size: 20px;
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    .logo-text img {
        height: 30px;
        margin-right: 5px;
    }

    .contact-info {
        font-size: 14px;
        color: var(--vsg-red);
        font-weight: bold;
    }

    .header-icons a {
        color: #777;
        margin-left: 15px;
        position: relative;
        font-size: 18px;
    }

    .main-menu .nav-link {
        padding: 12px 15px;
        font-weight: 500;
        color: #333;
        text-transform: uppercase;
        font-size: 14px;
    }

    .main-menu .nav-link:hover {
        color: var(--primary-green);
    }

    /* ================================================= */
    /* BANNER CHÍNH (Bắt đầu ngay dưới Header) */
    /* ================================================= */
    .main-header-banner {
        position: fixed;
        top: var(--header-total-height);
        left: 0;
        width: 100%;
        height: var(--banner-height);
        z-index: 1;

        /* THIẾT LẬP ĐỂ ẢNH LẶP LẠI (GIỐNG HÌNH BẠN GỬI) */

        /* 1. Cho phép ảnh lặp lại (Tile) */
        background-repeat: repeat-x;

        /* 2. KHÔNG dùng cover (vì cover sẽ ép ảnh to ra và mất hiệu ứng lặp) */
        /* Bạn có thể để 'contain' hoặc một kích thước % cố định để thấy rõ sự lặp lại */
        background-size: contain;

        /* 3. Căn ảnh gốc nằm ở giữa, phần thừa 2 bên sẽ tự lặp lại nửa đầu/nửa cuối ảnh */
        background-position: center center;

        /* Giữ cố định ảnh khi cuộn */
        background-attachment: fixed;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .main-header-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.25);
    }

    .banner-content {
        position: relative;
        z-index: 10;
        color: white;
        text-align: center;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
    }

    .banner-category {
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 2px;
        margin-bottom: 5px;
        color: #d1d1d1;
        background-color: rgba(0, 0, 0, 0.3);
        padding: 5px 10px;
        border-radius: 3px;
        display: inline-block;
    }

    /* ================================================= */
    /* NỘI DUNG CUỘN (Lấp đầy khoảng trống) */
    /* ================================================= */
    .main-content-wrapper {
        margin-top: calc(var(--header-total-height) + var(--banner-height));
        position: relative;
        z-index: 10;
        /* Đè lên Banner khi cuộn chuột */
        background-color: #fff;
        /* Nền trắng che banner */
    }

    .article-content-wrapper {
        background-color: #fff;
        padding: 40px 0;
    }

    /* ================================================= */
    /* CÁC THÀNH PHẦN NỘI DUNG */
    /* ================================================= */
    .content-index {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 30px;
        background-color: #fff;
        border-radius: 5px;
    }

    .index-header {
        font-size: 18px;
        font-weight: bold;
        color: var(--toc-green);
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        display: flex;
        justify-content: space-between;
        cursor: pointer;
    }

    .index-list {
        list-style: none;
        padding: 0;
        margin: 10px 0 0 0;
    }

    .index-list a:hover {
        color: var(--primary-green);
        text-decoration: underline;
    }

    .article-body h2 {
        color: var(--toc-green);
        font-size: 24px;
        font-weight: bold;
        margin-top: 35px;
        border-bottom: 2px solid #eee;
        padding-bottom: 8px;
    }

    .article-body p {
        line-height: 1.8;
        color: #333;
        margin-bottom: 18px;
    }

    .article-body img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 25px auto;
        border-radius: 4px;
    }
    </style>
</head>

<body>

    <div class="main-header-banner"
        style="background-image: url('https://vuonsaigon.vn/wp-content/uploads/2025/11/Ky-thuat-trong-hoa-trieu-chuong-khoe-sac-dung-dip-Tet-nguyen-dan-4.png');">
        <div class="banner-content">
            <p class="banner-category">KỸ THUẬT NÔNG NGHIỆP</p>
            <h1 class="banner-title">Kỹ thuật trồng hoa triều chuông</h1>
            <h2 class="banner-subtitle">khoẻ sắc dùng dịp Tết Nguyên Đán</h2>
            <p class="banner-meta">08/12/2025 | Bởi Thủy Hoa</p>
        </div>
    </div>

    <div class="main-content-wrapper">

        <div class="article-content-wrapper">

            <div class="container main-content">

                <div class="content-index shadow-sm">
                    <div class="index-header"
                        onclick="document.getElementById('indexList').classList.toggle('d-none');">
                        <span>
                            <i class="fas fa-list-ul me-2"></i>Nội dung chính
                        </span>
                        <i class="fas fa-chevron-down"></i>
                    </div>

                    <ul class="index-list" id="indexList">
                        <li>1. <a href="#muc1">Trồng hoa triều chuông vào thời điểm nào để cho hoa dùng vào dịp Tết?</a>
                        </li>
                        <li>2. <a href="#muc2">Cách chọn giống và phương pháp nhân giống hoa triều chuông</a></li>
                        <li>3. <a href="#muc3">Cách trồng hoa triều chuông ra nhiều hoa</a></li>
                        <li>4. <a href="#muc4">Cách chăm sóc cho cây hoa triều chuông cho nhiều hoa đẹp rực rỡ</a>
                            <ul class="index-list ps-3 mt-1">
                                <li class="sub-item"><a href="#muc4-1">4.1 Nước tưới nước: cho cây hoa triều chuông</a>
                                </li>
                                <li class="sub-item"><a href="#muc4-2">4.2 Cách bón phân cho cây hoa triều chuông</a>
                                </li>
                                <li class="sub-item"><a href="#muc4-3">4.3 Cách phòng trừ sâu bệnh hại cây hoa triều
                                        chuông</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="article-body">

                    <p>Không chỉ mang vẻ đẹp cuốn hút, hoa triều chuông còn là biểu tượng của sự bền bỉ và sức sống mãnh
                        liệt. Đặc biệt, khi nở rộ vào dịp Tết Nguyên Đán, những chậu hoa rực rỡ sẽ làm không gian nhà
                        bạn thêm phần thơ mộng và đầy sắc xuân. Các bạn hãy cùng **Vườn Sài Gòn** tìm hiểu cách trồng
                        loài hoa này qua bài viết này nhé.</p>

                    <h2 id="muc1">1. Trồng hoa triều chuông vào thời điểm nào để cho hoa dùng vào dịp Tết?</h2>

                    <p>– Cây hoa triệu chuông không quá yêu cầu khắt khe về điều kiện khí hậu. Tuy nhiên, cây ưa điều
                        kiện thời tiết mát mẻ. Cây sinh trưởng phát triển tốt ở những nơi có nhiệt độ từ
                        $15^\circ\text{C}$ – $30^\circ\text{C}$ và thích ánh sáng tán xạ (sợ ánh sáng trực tiếp).
                    <p>– Thời điểm thích hợp để trồng hoa triệu chuông tùy vào đặc điểm khí hậu của mỗi vùng trồng. Đối
                        với các vùng có khí hậu mát mẻ như Đà Lạt, Sa pa, Mộc châu, … có thể trồng hoa quanh năm. Đối
                        với các vùng có những thời điểm nắng nóng hơn $30^\circ\text{C}$ thì nên tránh trồng hoặc nếu
                        trồng cần có biện pháp che bóng và điều khiển nhiệt độ cho cây. Các vùng miền Bắc nên trồng vào
                        mùa thu từ tháng 8 đến tháng 4 năm sau dương lịch.
                    <p>– Hoa Triệu chuông sau khi trồng khoảng $75$ – $90$ ngày thì cây bắt đầu cho hoa. Cây nở hoa liên
                        tục từ $4$ – $6$ tháng tiếp theo, nên tùy vào mục đích của người trồng để có thể điều chỉnh thời
                        điểm trồng để cây có thể ra hoa đúng dịp như ý muốn. Để cây nở hoa vào dúng dịp Tết Nguyên Đán
                        thì nên trồng vào tháng $8$ – $9$ dương lịch.
                        <img
                            src="https://vuonsaigon.vn/wp-content/uploads/2025/11/Ky-thuat-trong-hoa-trieu-chuong-khoe-sac-dung-dip-Tet-nguyen-dan-768x768.png">


                    <h2 id="muc2">2. Cách chọn giống và phương pháp nhân giống hoa triều chuông</h2>

                    Hiện nay trên thị trường có rất nhiều loại hoa triều chuông với các màu sắc khác nhau như đỏ,
                        hồng, tím, trắng và các màu phối trộn bắt mắt. Nhưng phổ biến nhất là các màu mix đang được ưa
                        chuộng. Tùy vào sở thích, ý tưởng trang trí mà chọn các giống hoa triều chuông có màu sắc thích
                        hợp.

                    <p><strong>Nhân giống:</strong> Hoa triều chuông có thể trồng bằng cả hai phương pháp phổ biến đó là
                        **gieo hạt** và **cây con** (cây nuôi cấy mô, cây giâm cành). Nếu trồng nhiều có thể trồng bằng
                        phương pháp gieo hạt, trường hợp trồng ít thì nên trồng cây con.</p>

                    <img src="https://vuonsaigon.vn/wp-content/uploads/2023/07/cua-hang-vat-tu-nong-nghiep.png"
                        alt="Cây triều chuông con">

                    <p>– Nếu trồng từ hạt giống, vì hạt nhỏ nên không cần xử lý hạt giống trước khi gieo, tránh làm mất
                        sức nảy mầm của hạt giống.</p>

                    <p><strong>Chậu trồng:</strong> nên trồng trong chậu có kích cỡ đường kính miệng chậu $20$ – $25$cm.
                    </p>
                    <p>Là loài hoa có vẻ đẹp bởi các cành hoa rủ xuống. Vì vậy nên chọn các dạng chậu hình chảo, chậu để
                        treo có các hình dạng khác nhau.</p>

                    <p><strong>Đất trồng:</strong> Cây hoa triều chuông là cây ưa ẩm nhưng sợ úng, nên giá thể cần đảm
                        bảo độ tơi xốp, thoát nước tốt. Bạn hãy dùng **đất sạch Orgamix 3 in 1** để trồng.</p>

                    <p><strong>Ánh sáng:</strong> Cây hoa triều chuông là cây ưa ánh sáng tán xạ. Nên đặt cây ở các vị
                        trí thoáng mát, tránh ánh sáng trực tiếp. Hoặc nếu trồng ở điều kiện nắng gắt thì nên có các
                        biện pháp che chắn hợp lý để cây sinh trưởng trong môi trường tốt nhất.</p>

                    <h2 id="muc4">4. Cách chăm sóc cho cây hoa triều chuông cho nhiều hoa đẹp rực rỡ</h2>

                    <h3 id="muc4-1">4.1 Nước tưới nước cho cây hoa triều chuông</h3>

                    <p>– Thường xuyên kiểm tra độ ẩm đất. Độ ẩm đất cần luôn duy trì từ $60$ – $70\%$, nếu thấy thiếu
                        hụt cần bổ sung nước ngay vì cây dễ bị héo. Nếu như dư nước cần thoát nước tạo độ thông thoáng
                        cho đất.</p>

                    <p>– Khi mới trồng cây con không yêu cầu quá nhiều nước nhưng luôn phải duy trì độ ẩm để rễ nhanh
                        phát triển, nên tưới $2$–$3$ lần/ngày mỗi lần chỉ tưới nhẹ.</p>

                    <p>– Sau trồng $20$ – $35$ ngày cây sinh trưởng phát triển mạnh, ra nhiều nhánh và cây ổn định tưới
                        $2$ lần/ngày với lượng nước mỗi lần tưới nhiều hơn. Tùy vào thời tiết và độ ẩm đất để định lượng
                        số lần tưới nước cho hoa, nhưng mỗi lần chỉ nên tưới vừa đủ, cây con tuổi nhẹ. Không tưới đẫm và
                        tưới ngập, tránh tình trạng bị thối gốc, thối lá và gây chết cây.</p>

                    <h3 id="muc4-2">4.2 Cách bón phân cho cây hoa triều chuông</h3>

                    <p>– Cây hoa triều chuông có khả năng sinh trưởng phát triển mạnh, cho các đợt hoa liên tục và kéo
                        dài nên cây cần bổ sung nhiều dinh dưỡng. Tuy nhiên, cây không ưa bón phân nặng dễ gây chết cây,
                        chỉ tiến hành pha phân loãng, bón nhẹ cho cây và bón đều đặn để cây sinh trưởng phát triển tối
                        ưu.</p>

                    <p>– Sau trồng $15$ – $20$ ngày, cây ổn định, để phát triển thân lá, nhánh mới thì bón **phân hữu cơ
                        trùn quế** hoặc **phân gà japadi**. Liều lượng bón cho cây hoa triều chuông giảm nồng độ một nửa
                        so với khuyến cáo nhà sản xuất. Trong giai đoạn này bón phân định kỳ $14$ ngày/lần.</p>

                    <h3 id="muc4-3">4.3 Cách phòng trừ sâu bệnh hại cây hoa triều chuông</h3>

                    <p>Nội dung chi tiết...</p>

                    <div class="team-section mt-5 border p-4 rounded">
                        <h2 class="text-center text-uppercase fw-bold mb-3" style="color: var(--primary-green);">
                            ĐỘI NGŨ
                        </h2>

                        <p class="text-justify mb-4" style="line-height: 1.8; font-size: 16px; color: #333;">
                            Với nòng cốt là đội ngũ kỹ sư nông nghiệp giàu kinh nghiệm, có trình độ chuyên môn cao, đến
                            với Vườn Sài Gòn quý khách không chỉ được tư vấn lựa chọn sản phẩm phù hợp, mà còn được tư
                            vấn về kỹ thuật cây trồng, đưa ra những giải pháp hiệu quả cho quý khách.
                        </p>

                        <div class=" team-image text-center">
                            <img src="https://vuonsaigon.vn/wp-content/uploads/2022/01/Main-3.00_00_12_15.Still006-1024x576.jpg"
                                alt="Đội ngũ kỹ sư Vườn Sài Gòn" class="img-fluid shadow-sm rounded">
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
        // Script để ẩn hiện mục lục (TOC)
        document.addEventListener('DOMContentLoaded', function() {
            const indexHeader = document.querySelector('.index-header');
            const indexList = document.getElementById('indexList');
            const chevronIcon = indexHeader.querySelector('.fa-chevron-down');

            indexHeader.addEventListener('click', function() {
                indexList.classList.toggle('d-none');
                chevronIcon.classList.toggle('fa-rotate-180'); // Xoay mũi tên khi ẩn/hiện
            });
        });
        </script>
</body>

</html>