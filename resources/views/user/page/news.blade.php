@extends('user.master_latout.main')

@section('title', 'Tin tức')

@section('main')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero__container">
            <h1 class="hero__title">Tin Tức Cầu Lông</h1>
            <p class="hero__subtitle">
                Cập nhật những thông tin mới nhất về thế giới cầu lông,
                kỹ thuật chơi, và các sản phẩm vợt cầu lông chất lượng cao
            </p>
        </div>
    </section>

    <!-- News Section -->
    <section class="news">
        <div class="news__container">
            <!-- Main News Content -->
            <div class="news__main">
                <!-- Featured Article -->
                <article class="news__featured">
                    <img src="https://photo.znews.vn/w660/Uploaded/mdf_uswreo/2024_08_04/Snapinsta.app_427987651_414356787937697_7582737740950160380_n_1080.jpg"
                        alt="Tin tức nổi bật" class="news__image">
                    <div class="news__content">
                        <span class="news__category">Kỹ Thuật</span>
                        <h2 class="news__title">
                            5 Kỹ Thuật Cơ Bản Giúp Bạn Chơi Cầu Lông Như Chuyên Gia
                        </h2>
                        <p class="news__excerpt">
                            Khám phá những kỹ thuật cơ bản nhưng quan trọng trong cầu lông.
                            Từ cách cầm vợt đúng cách đến các động tác đánh cầu hiệu quả,
                            bài viết này sẽ giúp bạn nâng cao trình độ chơi cầu lông một cách đáng kể.
                        </p>
                        <div class="news__meta">
                            <div class="news__date">
                                <i class="far fa-calendar"></i>
                                <span>15 Tháng 12, 2024</span>
                            </div>
                            <div class="news__author">
                                <i class="far fa-user"></i>
                                <span>Admin</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- News Grid -->
                <div class="news__grid">
                    <article class="news__card">
                        <img src="https://photo.znews.vn/w660/Uploaded/mdf_uswreo/2024_08_04/Snapinsta.app_427987651_414356787937697_7582737740950160380_n_1080.jpg"
                            alt="Vợt cầu lông mới" class="news__image">
                        <div class="news__content">
                            <span class="news__category">Sản Phẩm</span>
                            <h3 class="news__title">
                                Ra Mắt Dòng Vợt Cầu Lông Cao Cấp 2024
                            </h3>
                            <p class="news__excerpt">
                                Khám phá bộ sưu tập vợt cầu lông mới nhất với công nghệ tiên tiến,
                                mang đến trải nghiệm chơi tuyệt vời cho người chơi ở mọi trình độ.
                            </p>
                            <div class="news__meta">
                                <div class="news__date">
                                    <i class="far fa-calendar"></i>
                                    <span>12 Tháng 12, 2024</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="news__card">
                        <img src="https://photo.znews.vn/w660/Uploaded/mdf_uswreo/2024_08_04/Snapinsta.app_427987651_414356787937697_7582737740950160380_n_1080.jpg"
                            alt="Giải đấu cầu lông" class="news__image">
                        <div class="news__content">
                            <span class="news__category">Sự Kiện</span>
                            <h3 class="news__title">
                                Giải Đấu Cầu Lông Mùa Đông 2024
                            </h3>
                            <p class="news__excerpt">
                                Tham gia giải đấu cầu lông lớn nhất trong năm với nhiều giải thưởng
                                hấp dẫn và cơ hội giao lưu với các tay vợt giỏi.
                            </p>
                            <div class="news__meta">
                                <div class="news__date">
                                    <i class="far fa-calendar"></i>
                                    <span>10 Tháng 12, 2024</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="news__card">
                        <img src="https://photo.znews.vn/w660/Uploaded/mdf_uswreo/2024_08_04/Snapinsta.app_427987651_414356787937697_7582737740950160380_n_1080.jpg"
                            alt="Bảo dưỡng vợt" class="news__image">
                        <div class="news__content">
                            <span class="news__category">Hướng Dẫn</span>
                            <h3 class="news__title">
                                Cách Bảo Dưỡng Vợt Cầu Lông Đúng Cách
                            </h3>
                            <p class="news__excerpt">
                                Hướng dẫn chi tiết cách bảo dưỡng và chăm sóc vợt cầu lông
                                để duy trì hiệu suất tốt nhất và kéo dài tuổi thọ sản phẩm.
                            </p>
                            <div class="news__meta">
                                <div class="news__date">
                                    <i class="far fa-calendar"></i>
                                    <span>8 Tháng 12, 2024</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="news__card">
                        <img src="https://photo.znews.vn/w660/Uploaded/mdf_uswreo/2024_08_04/Snapinsta.app_427987651_414356787937697_7582737740950160380_n_1080.jpg"
                            alt="Lựa chọn vợt" class="news__image">
                        <div class="news__content">
                            <span class="news__category">Tư Vấn</span>
                            <h3 class="news__title">
                                Làm Thế Nào Để Chọn Vợt Cầu Lông Phù Hợp
                            </h3>
                            <p class="news__excerpt">
                                Tư vấn chi tiết về cách lựa chọn vợt cầu lông phù hợp với
                                trình độ, phong cách chơi và ngân sách của bạn.
                            </p>
                            <div class="news__meta">
                                <div class="news__date">
                                    <i class="far fa-calendar"></i>
                                    <span>5 Tháng 12, 2024</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="sidebar">
                <!-- Popular Posts -->
                <div class="sidebar__section">
                    <h3 class="sidebar__title">Tin Nổi Bật</h3>
                    <div class="sidebar__item">
                        <img src="https://photo.znews.vn/w660/Uploaded/mdf_uswreo/2024_08_04/Snapinsta.app_427987651_414356787937697_7582737740950160380_n_1080.jpg"
                            alt="Tin nổi bật 1" class="sidebar__item-image">
                        <div class="sidebar__item-content">
                            <h4 class="sidebar__item-title">
                                Top 10 Vợt Cầu Lông Tốt Nhất Năm 2024
                            </h4>
                            <span class="sidebar__item-date">3 Tháng 12, 2024</span>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <img src="https://photo.znews.vn/w660/Uploaded/mdf_uswreo/2024_08_04/Snapinsta.app_427987651_414356787937697_7582737740950160380_n_1080.jpg"
                            alt="Tin nổi bật 2" class="sidebar__item-image">
                        <div class="sidebar__item-content">
                            <h4 class="sidebar__item-title">
                                Kỹ Thuật Smash Hiệu Quả Trong Cầu Lông
                            </h4>
                            <span class="sidebar__item-date">1 Tháng 12, 2024</span>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <img src="https://photo.znews.vn/w660/Uploaded/mdf_uswreo/2024_08_04/Snapinsta.app_427987651_414356787937697_7582737740950160380_n_1080.jpg"
                            alt="Tin nổi bật 3" class="sidebar__item-image">
                        <div class="sidebar__item-content">
                            <h4 class="sidebar__item-title">
                                Lịch Sử Phát Triển Của Môn Cầu Lông
                            </h4>
                            <span class="sidebar__item-date">28 Tháng 11, 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="sidebar__section">
                    <h3 class="sidebar__title">Danh Mục</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <a href="#"
                            style="color: var(--text-color); text-decoration: none; padding: 0.5rem 0; border-bottom: 1px solid var(--light);">
                            <i class="fas fa-tag" style="margin-right: 0.5rem; color: var(--primary-one);"></i>
                            Kỹ Thuật (12)
                        </a>
                        <a href="#"
                            style="color: var(--text-color); text-decoration: none; padding: 0.5rem 0; border-bottom: 1px solid var(--light);">
                            <i class="fas fa-tag" style="margin-right: 0.5rem; color: var(--primary-one);"></i>
                            Sản Phẩm (8)
                        </a>
                        <a href="#"
                            style="color: var(--text-color); text-decoration: none; padding: 0.5rem 0; border-bottom: 1px solid var(--light);">
                            <i class="fas fa-tag" style="margin-right: 0.5rem; color: var(--primary-one);"></i>
                            Sự Kiện (5)
                        </a>
                        <a href="#"
                            style="color: var(--text-color); text-decoration: none; padding: 0.5rem 0; border-bottom: 1px solid var(--light);">
                            <i class="fas fa-tag" style="margin-right: 0.5rem; color: var(--primary-one);"></i>
                            Hướng Dẫn (15)
                        </a>
                        <a href="#" style="color: var(--text-color); text-decoration: none; padding: 0.5rem 0;">
                            <i class="fas fa-tag" style="margin-right: 0.5rem; color: var(--primary-one);"></i>
                            Tư Vấn (7)
                        </a>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="newsletter">
                    <h3 class="newsletter__title">Đăng Ký Nhận Tin</h3>
                    <p class="newsletter__text">
                        Nhận thông tin mới nhất về sản phẩm và khuyến mãi
                    </p>
                    <form class="newsletter__form">
                        <input type="email" placeholder="Email của bạn" class="newsletter__input" required>
                        <button type="submit" class="newsletter__button">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </section>
@endsection
