@extends('user.master_latout.main')

@section('title', 'Giới thiệu')

@section('main')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero__container">
            <h1 class="hero__title">Về Badminton Shop</h1>
            <p class="hero__subtitle">
                Chúng tôi là đối tác đáng tin cậy của bạn trong hành trình chinh phục đỉnh cao cầu lông.
                Với hơn 10 năm kinh nghiệm, chúng tôi cam kết mang đến những sản phẩm chất lượng nhất
                và dịch vụ tận tâm cho cộng đồng yêu cầu lông Việt Nam.
            </p>

            <div class="hero__stats">
                <div class="hero__stat">
                    <span class="hero__stat-number">10+</span>
                    <span class="hero__stat-text">Năm Kinh Nghiệm</span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number">50K+</span>
                    <span class="hero__stat-text">Khách Hàng Tin Tưởng</span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number">500+</span>
                    <span class="hero__stat-text">Sản Phẩm Chất Lượng</span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number">99%</span>
                    <span class="hero__stat-text">Khách Hàng Hài Lòng</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="section">
        <div class="container">
            <div class="story">
                <div class="story__content">
                    <h3>Câu Chuyện Của Chúng Tôi</h3>
                    <p>
                        Badminton Shop được thành lập vào năm 2014 bởi những người đam mê cầu lông.
                        Xuất phát từ niềm yêu thích môn thể thao này, chúng tôi nhận thấy nhu cầu
                        về những sản phẩm cầu lông chất lượng cao tại Việt Nam ngày càng tăng.
                    </p>
                    <p>
                        Từ một cửa hàng nhỏ, chúng tôi đã không ngừng phát triển và mở rộng.
                        Ngày nay, Badminton Shop tự hào là một trong những địa chỉ uy tín hàng đầu
                        về vợt cầu lông và phụ kiện cầu lông tại Việt Nam.
                    </p>
                    <p>
                        Chúng tôi luôn đặt chất lượng sản phẩm và sự hài lòng của khách hàng
                        lên hàng đầu. Mỗi sản phẩm được chúng tôi tuyển chọn kỹ lưỡng từ những
                        thương hiệu uy tín trên thế giới.
                    </p>
                </div>
                <div class="story__image-container">
                    <img src="https://cdn-i.vtcnews.vn/resize/th/upload/2024/07/30/shida1-15381028.jpg"
                        alt="Câu chuyện Badminton Shop" class="story__image">
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <div class="container">
        <section class="mission">
            <div class="mission__content">
                <h2 class="mission__title">Sứ Mệnh Của Chúng Tôi</h2>
                <p class="mission__text">
                    "Mang đến cho mọi người những sản phẩm cầu lông chất lượng cao nhất,
                    giúp họ phát huy tối đa khả năng và niềm đam mê với môn thể thao tuyệt vời này.
                    Chúng tôi không chỉ bán sản phẩm mà còn chia sẻ kiến thức, kinh nghiệm
                    và tạo ra một cộng đồng cầu lông mạnh mẽ tại Việt Nam."
                </p>
            </div>
        </section>
    </div>

    <!-- Values Section -->
    <section class="section section--light">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Giá Trị Cốt Lõi</h2>
                <p class="section__subtitle">
                    Những giá trị định hướng mọi hoạt động của chúng tôi
                </p>
            </div>

            <div class="values">
                <div class="value__card">
                    <div class="value__icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="value__title">Chất Lượng Hàng Đầu</h3>
                    <p class="value__description">
                        Chúng tôi chỉ cung cấp những sản phẩm đạt tiêu chuẩn chất lượng cao nhất,
                        được kiểm định kỹ lưỡng từ những thương hiệu uy tín trên thế giới.
                    </p>
                </div>

                <div class="value__card">
                    <div class="value__icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="value__title">Tận Tâm Phục Vụ</h3>
                    <p class="value__description">
                        Đội ngũ nhân viên giàu kinh nghiệm luôn sẵn sàng tư vấn và hỗ trợ khách hàng
                        tìm được sản phẩm phù hợp nhất với nhu cầu và trình độ.
                    </p>
                </div>

                <div class="value__card">
                    <div class="value__icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="value__title">Uy Tín & Tin Cậy</h3>
                    <p class="value__description">
                        Hơn 10 năm xây dựng và phát triển, chúng tôi tự hào về uy tín và sự tin tưởng
                        mà khách hàng dành cho Badminton Shop.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Đội Ngũ Của Chúng Tôi</h2>
                <p class="section__subtitle">
                    Những con người tận tâm đứng sau thành công của Badminton Shop
                </p>
            </div>

            <div class="team">
                <div class="team__member">
                    <img src="https://gamek.mediacdn.vn/133514250583805952/2022/12/22/20-16716404983951175170303-1671704731909-1671704731968770979470.jpg"
                        alt="Nguyễn Văn An" class="team__image">
                    <div class="team__info">
                        <h3 class="team__name">Nguyễn Văn An</h3>
                        <p class="team__position">Giám Đốc & Người Sáng Lập</p>
                        <p class="team__description">
                            Với hơn 15 năm kinh nghiệm trong lĩnh vực cầu lông,
                            anh An là người đặt nền móng cho Badminton Shop.
                        </p>
                        <div class="team__social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <div class="team__member">
                    <img src="https://gamek.mediacdn.vn/133514250583805952/2022/12/22/20-16716404983951175170303-1671704731909-1671704731968770979470.jpg"
                        alt="Trần Thị Bình" class="team__image">
                    <div class="team__info">
                        <h3 class="team__name">Trần Thị Bình</h3>
                        <p class="team__position">Trưởng Phòng Kinh Doanh</p>
                        <p class="team__description">
                            Chuyên gia tư vấn sản phẩm với kiến thức sâu rộng
                            về các dòng vợt cầu lông chuyên nghiệp.
                        </p>
                        <div class="team__social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <div class="team__member">
                    <img src="https://gamek.mediacdn.vn/133514250583805952/2022/12/22/20-16716404983951175170303-1671704731909-1671704731968770979470.jpg"
                        alt="Lê Minh Cường" class="team__image">
                    <div class="team__info">
                        <h3 class="team__name">Lê Minh Cường</h3>
                        <p class="team__position">Chuyên Viên Kỹ Thuật</p>
                        <p class="team__description">
                            Cựu vận động viên cầu lông chuyên nghiệp,
                            hiện đảm nhận việc tư vấn kỹ thuật và đào tạo.
                        </p>
                        <div class="team__social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <div class="team__member">
                    <img src="https://gamek.mediacdn.vn/133514250583805952/2022/12/22/20-16716404983951175170303-1671704731909-1671704731968770979470.jpg"
                        alt="Phạm Thu Dung" class="team__image">
                    <div class="team__info">
                        <h3 class="team__name">Phạm Thu Dung</h3>
                        <p class="team__position">Trưởng Phòng Chăm Sóc KH</p>
                        <p class="team__description">
                            Đảm bảo mọi khách hàng đều nhận được sự phục vụ
                            tốt nhất và giải quyết mọi thắc mắc một cách nhanh chóng.
                        </p>
                        <div class="team__social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="contact-cta">
        <div class="container">
            <h2 class="contact-cta__title">Sẵn Sàng Bắt Đầu Hành Trình Cầu Lông?</h2>
            <p class="contact-cta__text">
                Hãy để chúng tôi giúp bạn tìm được những sản phẩm cầu lông hoàn hảo nhất.
                Liên hệ ngay để được tư vấn miễn phí!
            </p>
            <div class="contact-cta__buttons">
                <a href="#" class="btn btn--primary">
                    <i class="fas fa-phone"></i>
                    Liên Hệ Ngay
                </a>
                <a href="#" class="btn btn--outline">
                    <i class="fas fa-store"></i>
                    Xem Sản Phẩm
                </a>
            </div>
        </div>
    </section>
@endsection
