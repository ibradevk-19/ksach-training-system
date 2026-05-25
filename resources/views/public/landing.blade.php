<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> التمكين الاقتصادي | المسارات التدريبية</title>

  <!-- Google Font: Cairo -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 RTL -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  <!-- Tabler RTL -->
  <link href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.rtl.min.css" rel="stylesheet">

  <!-- Tabler Icons -->
  <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" rel="stylesheet">

  <style>
    :root {
      --primary: #0f766e;
      --primary-2: #14b8a6;
      --primary-dark: #115e59;
      --secondary: #f59e0b;
      --blue: #2563eb;
      --purple: #7c3aed;
      --dark: #0f172a;
      --muted: #64748b;
      --light: #f8fafc;
      --soft: #f0fdfa;
      --white: #ffffff;
      --radius-sm: 14px;
      --radius-md: 20px;
      --radius-lg: 28px;
      --shadow-soft: 0 14px 45px rgba(15, 23, 42, .07);
      --shadow-deep: 0 26px 80px rgba(15, 23, 42, .13);
      --gradient-main: linear-gradient(135deg, #0f766e 0%, #14b8a6 55%, #22c55e 100%);
      --gradient-gold: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
      --gradient-blue: linear-gradient(135deg, #2563eb 0%, #38bdf8 100%);
    }

    * {
      font-family: "Cairo", sans-serif;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      background: var(--light);
      color: var(--dark);
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
    }

    .section-padding {
      padding: 92px 0;
    }

    .navbar {
      background: rgba(255, 255, 255, .88);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      box-shadow: 0 12px 40px rgba(15, 23, 42, .06);
      transition: all .25s ease;
    }

    .navbar-brand {
      font-weight: 900;
      color: var(--dark);
    }

    .brand-logo {
      width: 126px;
      height: 54px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .brand-logo img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
    }

    .footer .brand-logo {
      width: 150px;
      height: 64px;
    }

    .nav-link {
      color: #334155;
      font-weight: 800;
      transition: .2s ease;
    }

    .nav-link:hover {
      color: var(--primary);
    }

    .btn-gradient {
      background: var(--gradient-main);
      color: #fff;
      border: 0;
      border-radius: 999px;
      padding: 13px 28px;
      font-weight: 900;
      box-shadow: 0 18px 38px rgba(15, 118, 110, .26);
      transition: all .25s ease;
    }

    .btn-gradient:hover {
      color: #fff;
      transform: translateY(-4px);
      box-shadow: 0 28px 58px rgba(15, 118, 110, .36);
    }

    .btn-outline-soft {
      background: rgba(255, 255, 255, .72);
      color: var(--primary-dark);
      border: 1px solid rgba(15, 118, 110, .18);
      border-radius: 999px;
      padding: 13px 28px;
      font-weight: 900;
      transition: all .25s ease;
    }

	    .btn-outline-soft:hover {
	      background: var(--soft);
	      color: var(--primary-dark);
	      transform: translateY(-4px);
	      box-shadow: var(--shadow-soft);
	    }

	    .funder-section {
	      padding: 104px 0 26px;
	      background: #fff;
	    }

	    .funder-panel {
	      display: grid;
	      grid-template-columns: 1fr minmax(260px, 360px);
	      align-items: center;
	      gap: 34px;
	      padding: 34px;
	      border: 1px solid rgba(15, 23, 42, .08);
	      border-radius: var(--radius-lg);
	      background:
	        radial-gradient(circle at 15% 20%, rgba(245, 158, 11, .14), transparent 30%),
	        linear-gradient(135deg, rgba(240, 253, 250, .94), rgba(255, 255, 255, .98)),
	        #fff;
	      box-shadow: var(--shadow-soft);
	    }

	    .funder-content {
	      max-width: 740px;
	    }

	    .funder-logos {
	      display: grid;
	      grid-template-columns: 1fr;
	      align-items: stretch;
	      gap: 14px;
	    }

	    .funder-logo-box {
	      min-height: 118px;
	      display: flex;
	      align-items: center;
	      justify-content: center;
	      padding: 18px;
	      border-radius: 22px;
	      background: #fff;
	      border: 1px solid rgba(15, 23, 42, .06);
	    }

	    .funder-logo-box.is-primary {
	      min-height: 150px;
	      border-color: rgba(15, 118, 110, .16);
	      box-shadow: 0 16px 36px rgba(15, 118, 110, .1);
	    }

	    .funder-logo-box img {
	      width: 100%;
	      max-width: 214px;
	      height: auto;
	      display: block;
	    }

	    .funder-logo-caption {
	      margin: 8px 0 0;
	      color: var(--muted);
	      font-size: .9rem;
	      font-weight: 800;
	      text-align: center;
	    }

	    .funder-kicker {
	      display: inline-flex;
	      align-items: center;
	      gap: 8px;
	      margin-bottom: 10px;
	      color: var(--primary-dark);
	      font-weight: 900;
	    }

	    .funder-kicker i {
	      color: var(--secondary);
	      font-size: 1.2rem;
	    }

	    .funder-title {
	      margin-bottom: 12px;
	      font-size: clamp(1.65rem, 2.5vw, 2.35rem);
	      font-weight: 900;
	      line-height: 1.45;
	    }

	    .funder-description {
	      margin: 0;
	      color: var(--muted);
	      line-height: 1.95;
	      font-weight: 700;
	    }

	    .funder-role-list {
	      display: grid;
	      grid-template-columns: repeat(3, minmax(0, 1fr));
	      gap: 12px;
	      margin-top: 22px;
	    }

	    .funder-role-item {
	      min-height: 116px;
	      padding: 18px;
	      border-radius: 20px;
	      background: rgba(255, 255, 255, .78);
	      border: 1px solid rgba(15, 23, 42, .07);
	    }

	    .funder-role-item i {
	      display: inline-flex;
	      align-items: center;
	      justify-content: center;
	      width: 40px;
	      height: 40px;
	      margin-bottom: 12px;
	      border-radius: 14px;
	      background: rgba(15, 118, 110, .1);
	      color: var(--primary-dark);
	      font-size: 22px;
	    }

	    .funder-role-item strong {
	      display: block;
	      margin-bottom: 6px;
	      font-weight: 900;
	      color: var(--dark);
	    }

	    .funder-role-item span {
	      display: block;
	      color: var(--muted);
	      line-height: 1.7;
	      font-size: .94rem;
	      font-weight: 700;
	    }

	    .hero-section {
	      position: relative;
	      min-height: 100vh;
      padding: 160px 0 95px;
      background:
        radial-gradient(circle at 10% 15%, rgba(20, 184, 166, .22), transparent 28%),
        radial-gradient(circle at 85% 10%, rgba(245, 158, 11, .18), transparent 24%),
        linear-gradient(180deg, #ffffff 0%, #ecfeff 100%);
      overflow: hidden;
    }

    .hero-section::before {
      content: "";
      position: absolute;
      width: 620px;
      height: 620px;
      border-radius: 50%;
      background: rgba(15, 118, 110, .07);
      left: -260px;
      top: 90px;
    }

    .hero-section::after {
      content: "";
      position: absolute;
      width: 360px;
      height: 360px;
      border-radius: 50%;
      background: rgba(245, 158, 11, .10);
      right: -160px;
      bottom: 40px;
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 18px;
      border-radius: 999px;
      background: rgba(15, 118, 110, .10);
      color: var(--primary-dark);
      font-weight: 900;
      margin-bottom: 22px;
    }

    .hero-title {
      font-size: clamp(2.25rem, 5vw, 5rem);
      font-weight: 900;
      line-height: 1.16;
      letter-spacing: -1px;
      margin-bottom: 22px;
    }

    .hero-title .highlight {
      background: linear-gradient(135deg, var(--primary), var(--primary-2), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero-description {
      color: var(--muted);
      font-size: 1.14rem;
      line-height: 2;
      max-width: 680px;
    }

    .hero-stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
      margin-top: 38px;
      max-width: 610px;
    }

    .hero-stat {
      background: rgba(255, 255, 255, .82);
      border: 1px solid rgba(15, 118, 110, .10);
      border-radius: var(--radius-md);
      padding: 18px;
      box-shadow: var(--shadow-soft);
      transition: .25s ease;
    }

    .hero-stat:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow-deep);
    }

    .hero-stat strong {
      display: block;
      font-size: 1.75rem;
      font-weight: 900;
      color: var(--primary-dark);
    }

    .hero-stat span {
      color: var(--muted);
      font-size: .92rem;
      font-weight: 700;
    }

    .hero-visual {
      position: relative;
      z-index: 2;
    }

    .visual-card {
      position: relative;
      border-radius: 36px;
      background: #fff;
      padding: 18px;
      box-shadow: var(--shadow-deep);
      transform: rotate(-1deg);
      border: 1px solid rgba(15, 23, 42, .06);
      overflow: hidden;
    }

    .visual-card img {
      width: 100%;
      height: 470px;
      object-fit: cover;
      border-radius: 28px;
      filter: saturate(1.03) contrast(1.02);
    }

    .visual-floating {
      position: absolute;
      bottom: 34px;
      right: 34px;
      left: 34px;
      background: rgba(255, 255, 255, .92);
      backdrop-filter: blur(14px);
      border-radius: 24px;
      padding: 18px;
      box-shadow: 0 18px 48px rgba(15, 23, 42, .18);
      border: 1px solid rgba(255, 255, 255, .7);
    }

    .floating-row {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .floating-icon {
      width: 52px;
      height: 52px;
      border-radius: 18px;
      background: var(--gradient-main);
      color: #fff;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 27px;
      flex-shrink: 0;
    }

    .section-heading {
      text-align: center;
      max-width: 850px;
      margin: 0 auto 48px;
    }

    .section-kicker {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 16px;
      border-radius: 999px;
      background: rgba(15, 118, 110, .10);
      color: var(--primary-dark);
      font-weight: 900;
      margin-bottom: 14px;
    }

    .section-title {
      font-size: clamp(1.85rem, 3vw, 3.2rem);
      font-weight: 900;
      margin-bottom: 16px;
      line-height: 1.35;
    }

    .section-description {
      color: var(--muted);
      line-height: 2;
      font-size: 1.06rem;
    }

    .about-section {
      background:
        radial-gradient(circle at 92% 8%, rgba(15, 118, 110, .08), transparent 26%),
        linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .about-story-card {
      position: relative;
      overflow: hidden;
      background:
        radial-gradient(circle at 12% 18%, rgba(20, 184, 166, .14), transparent 32%),
        linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
      border: 1px solid rgba(15, 118, 110, .10);
      border-radius: 34px;
      padding: 42px;
      box-shadow: var(--shadow-soft);
    }

    .about-story-card::before {
      content: "";
      position: absolute;
      inset-inline-start: 0;
      top: 0;
      width: 7px;
      height: 100%;
      background: var(--gradient-main);
    }

    .about-story-card h3 {
      font-size: 2rem;
      font-weight: 900;
      line-height: 1.45;
      margin-bottom: 18px;
    }

    .about-story-card p {
      color: var(--muted);
      line-height: 2.1;
      font-size: 1.06rem;
    }

    .about-lead {
      color: #334155;
      font-size: 1.13rem;
      font-weight: 700;
      line-height: 2.05;
    }

    .about-stat-strip {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
      margin: 28px 0;
    }

    .about-stat-pill {
      background: rgba(255, 255, 255, .84);
      border: 1px solid rgba(15, 118, 110, .12);
      border-radius: 22px;
      padding: 18px;
      box-shadow: 0 12px 32px rgba(15, 23, 42, .06);
    }

    .about-stat-pill strong {
      display: block;
      color: var(--primary-dark);
      font-size: 1.65rem;
      font-weight: 900;
      margin-bottom: 4px;
    }

    .about-stat-pill span {
      color: var(--muted);
      font-size: .92rem;
      font-weight: 800;
      line-height: 1.7;
    }

    .about-focus-list {
      display: grid;
      gap: 14px;
      margin-top: 26px;
    }

    .about-focus-item {
      display: flex;
      gap: 14px;
      align-items: flex-start;
      background: rgba(255, 255, 255, .76);
      border: 1px solid rgba(15, 23, 42, .06);
      border-radius: 22px;
      padding: 16px;
    }

    .about-focus-item i {
      width: 42px;
      height: 42px;
      border-radius: 16px;
      background: rgba(15, 118, 110, .11);
      color: var(--primary);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 23px;
      flex-shrink: 0;
    }

    .about-focus-item h4 {
      font-size: 1rem;
      font-weight: 900;
      margin-bottom: 4px;
    }

    .about-focus-item p {
      font-size: .94rem;
      line-height: 1.8;
      margin-bottom: 0;
    }

    .about-mini-card,
    .about-flow-card,
    .feature-card,
    .step-card,
    .testimonial-card,
    .track-card {
      background: #fff;
      border: 1px solid rgba(15, 23, 42, .06);
      border-radius: var(--radius-lg);
      padding: 28px;
      height: 100%;
      box-shadow: var(--shadow-soft);
      transition: all .25s ease;
    }

    .about-mini-card:hover,
    .about-flow-card:hover,
    .feature-card:hover,
    .step-card:hover,
    .testimonial-card:hover,
    .track-card:hover {
      transform: translateY(-8px);
      box-shadow: var(--shadow-deep);
      border-color: rgba(15, 118, 110, .20);
    }

    .icon-box {
      width: 64px;
      height: 64px;
      border-radius: 22px;
      background: rgba(15, 118, 110, .11);
      color: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 33px;
      margin-bottom: 20px;
    }

    .icon-gold {
      background: rgba(245, 158, 11, .13);
      color: #b45309;
    }

    .icon-blue {
      background: rgba(37, 99, 235, .12);
      color: var(--blue);
    }

    .icon-purple {
      background: rgba(124, 58, 237, .12);
      color: var(--purple);
    }

    .about-mini-card h4,
    .about-flow-card h4,
    .feature-card h3,
    .step-card h3,
    .track-card h3 {
      font-size: 1.24rem;
      font-weight: 900;
      margin-bottom: 12px;
    }

    .about-mini-card p,
    .about-flow-card p,
    .feature-card p,
    .step-card p,
    .track-card p,
    .testimonial-card p {
      color: var(--muted);
      line-height: 1.9;
      margin-bottom: 0;
    }

    .about-flow-card {
      padding: 24px;
    }

    .about-flow-card .icon-box {
      width: 58px;
      height: 58px;
      border-radius: 20px;
      font-size: 29px;
      margin-bottom: 18px;
    }

    .features-section {
      background:
        radial-gradient(circle at 90% 0%, rgba(37, 99, 235, .08), transparent 24%),
        #f8fafc;
    }

    .tracks-section {
      background: #fff;
    }

    .track-group-title {
      display: flex;
      align-items: center;
      gap: 14px;
      margin: 36px 0 26px;
    }

    .track-group-title::before,
    .track-group-title::after {
      content: "";
      height: 1px;
      background: rgba(100, 116, 139, .22);
      flex: 1;
    }

    .track-group-title span {
      background: #fff;
      color: var(--primary-dark);
      border: 1px solid rgba(15, 118, 110, .16);
      padding: 11px 24px;
      border-radius: 999px;
      font-weight: 900;
      box-shadow: var(--shadow-soft);
    }

    .track-card {
      position: relative;
      overflow: hidden;
    }

    .track-card::before {
      content: "";
      position: absolute;
      inset-inline-start: 0;
      top: 0;
      width: 100%;
      height: 6px;
      background: var(--gradient-main);
    }

    .track-card.digital::before {
      background: var(--gradient-blue);
    }

    .track-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin: 18px 0;
    }

    .track-meta span {
      background: #f1f5f9;
      color: #334155;
      border-radius: 999px;
      padding: 7px 12px;
      font-size: .83rem;
      font-weight: 800;
    }

    .track-list {
      padding-right: 18px;
      color: #475569;
      line-height: 2;
      margin-bottom: 22px;
      min-height: 125px;
    }

    .track-card .btn {
      width: 100%;
      justify-content: center;
    }

    .how-section {
      background:
        radial-gradient(circle at 10% 20%, rgba(15, 118, 110, .08), transparent 30%),
        linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    }

    .step-card {
      position: relative;
    }

    .step-number {
      width: 50px;
      height: 50px;
      border-radius: 18px;
      background: var(--gradient-main);
      color: #fff;
      font-weight: 900;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 18px;
      box-shadow: 0 15px 30px rgba(15, 118, 110, .25);
    }

    .testimonials-section {
      background: #fff;
    }

    .stars {
      color: #f59e0b;
      font-size: 1.15rem;
      margin-bottom: 16px;
    }

    .testimonial-profile {
      display: flex;
      align-items: center;
      margin-top: 22px;
    }

    .testimonial-avatar {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: var(--gradient-gold);
      color: #fff;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-weight: 900;
      margin-left: 12px;
      flex-shrink: 0;
    }

    .cta-section {
      background: #f8fafc;
    }

    .cta-card {
      border-radius: 36px;
      padding: 54px;
      background:
        radial-gradient(circle at 15% 20%, rgba(255,255,255,.22), transparent 25%),
        linear-gradient(135deg, var(--primary-dark), var(--primary), #0d9488);
      color: #fff;
      box-shadow: var(--shadow-deep);
      overflow: hidden;
      position: relative;
    }

    .cta-card::after {
      content: "";
      position: absolute;
      width: 260px;
      height: 260px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .11);
      left: -80px;
      bottom: -100px;
    }

    .footer {
      background: #0f172a;
      color: #cbd5e1;
      padding: 64px 0 26px;
    }

    .footer h4 {
      color: #fff;
      font-weight: 900;
      margin-bottom: 18px;
    }

    .footer a {
      color: #cbd5e1;
      display: inline-block;
      margin-bottom: 10px;
      transition: .2s ease;
    }

    .footer a:hover {
      color: #fff;
      transform: translateX(-4px);
    }

    .social-icon {
      width: 44px;
      height: 44px;
      border-radius: 15px;
      background: rgba(255,255,255,.08);
      color: #fff;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-left: 8px;
      transition: .25s ease;
      font-size: 22px;
    }

    .social-icon:hover {
      background: var(--primary);
      transform: translateY(-5px);
    }

	    @media (max-width: 991px) {
	      .funder-panel {
	        grid-template-columns: 1fr;
	        gap: 22px;
	      }

	      .funder-logos {
	        grid-template-columns: repeat(2, minmax(0, 1fr));
	        max-width: 620px;
	      }

	      .funder-role-list {
	        grid-template-columns: 1fr;
	      }

	      .hero-section {
	        padding-top: 130px;
	      }

      .visual-card {
        margin-top: 35px;
      }

      .visual-card img {
        height: 370px;
      }

      .hero-stats {
        grid-template-columns: 1fr;
      }

      .about-stat-strip {
        grid-template-columns: 1fr;
      }
    }

	    @media (max-width: 575px) {
	      .section-padding {
	        padding: 66px 0;
	      }

	      .funder-section {
	        padding: 88px 0 18px;
	      }

	      .funder-panel {
	        padding: 24px 20px;
	        border-radius: 22px;
	      }

	      .funder-logo-box {
	        min-height: 96px;
	        padding: 14px;
	      }

	      .funder-logo-box.is-primary {
	        min-height: 112px;
	      }

	      .funder-logos {
	        grid-template-columns: 1fr;
	      }

	      .hero-section {
	        padding: 120px 0 70px;
      }

      .hero-title {
        font-size: 2.3rem;
      }

      .cta-card,
      .about-story-card {
        padding: 30px 22px;
        border-radius: 26px;
      }

      .about-story-card h3 {
        font-size: 1.55rem;
      }

      .about-lead {
        font-size: 1rem;
      }

      .about-focus-item {
        padding: 14px;
      }

      .track-list {
        min-height: auto;
      }

      .visual-card img {
        height: 320px;
      }

      .visual-floating {
        position: static;
        margin-top: 16px;
      }
    }
  </style>
</head>

<body>

<header>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#home" aria-label="بوابة التمكين">
        <span class="brand-logo">
          <img src="{{ asset('logo-p.png') }}" alt="المركز السعودي للثقافة والتراث">
        </span>
        <span> تمكين</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="فتح القائمة">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#home">الرئيسية</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">عن المشروع</a></li>
          <li class="nav-item"><a class="nav-link" href="#tracks">المسارات</a></li>
          <li class="nav-item"><a class="nav-link" href="#how">كيف تبدأ؟</a></li>
        </ul>

        
      </div>
    </div>
  </nav>
</header>

<main>

	  <section class="funder-section" >
	    <div class="container">
	      <div class="funder-panel">
	        <div class="funder-content">
	          <div class="funder-kicker">
	            <i class="ti ti-heart-handshake"></i>
	            دعم إنساني وتنموي فاعل
	          </div>
	          <h2 class="funder-title">مركز الملك سلمان للإغاثة والأعمال الإنسانية يقود دعم التمكين الاقتصادي للفئات الأشد ضعفًا</h2>
	          <p class="funder-description">
	            يوفّر المركز الدعم الرئيسي لهذا المشروع عبر تمويل مسارات التدريب وبناء المهارات، بما يحوّل الاحتياج إلى فرص عملية تساعد المستفيدين على الوصول إلى دخل كريم ومستدام، وتعزز قدرة الأسر على الصمود والتعافي.
	          </p>

	          <div class="funder-role-list">
	            <div class="funder-role-item">
	              <i class="ti ti-school"></i>
	              <strong>تأهيل مهني مباشر</strong>
	              <span>دعم برامج تدريبية مرتبطة باحتياجات سوق العمل وفرص التشغيل.</span>
	            </div>
	            <div class="funder-role-item">
	              <i class="ti ti-users-group"></i>
	              <strong>استهداف الفئات الأشد ضعفًا</strong>
	              <span>توجيه الموارد نحو الأسر وذوي الإعاقة والفئات الأكثر احتياجًا.</span>
	            </div>
	            <div class="funder-role-item">
	              <i class="ti ti-chart-arrows-vertical"></i>
	              <strong>أثر مستدام</strong>
	              <span>تعزيز الاعتماد على الذات وتحسين سبل العيش على المدى الطويل.</span>
	            </div>
	          </div>
	        </div>

	        <div class="funder-logos" aria-label="شعارات الشركاء">
	          <div>
	            <div class="funder-logo-box is-primary">
	              <img src="https://www.ksrelief.org/assets/images/ksreliefLogoColored.svg" alt="شعار مركز الملك سلمان للإغاثة والأعمال الإنسانية">
	            </div>
	            <p class="funder-logo-caption">الداعم الرئيسي للمشروع</p>
	          </div>
	          <div>
	            <div class="funder-logo-box">
	              <img src="{{ asset('logo-p.png') }}" alt="شعار المركز السعودي للثقافة والتراث">
	            </div>
	            <p class="funder-logo-caption">الشريك التنفيذي</p>
	          </div>
	        </div>
	      </div>
	    </div>
	  </section>

	  <section class="hero-section" id="home">
	    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <div class="hero-content">
            <div class="hero-badge">
              <i class="ti ti-sparkles"></i>
              مشروع تدريبي لبناء مهارات قابلة للتشغيل
            </div>

            <h1 class="hero-title">
              نمكّنك من تحويل المهارة إلى
              <span class="highlight">فرصة دخل حقيقية</span>
            </h1>

            <p class="hero-description">
              بوابة التمكين الاقتصادي تجمع المسارات التدريبية المهنية والرقمية في مكان واحد، لتساعد الفئات الأكثر احتياجاً على اختيار المسار المناسب، التقديم بسهولة، وبناء مهارة عملية قابلة للعمل الحر أو التشغيل.
            </p>

            <div class="d-flex flex-wrap gap-3 mt-4">
              <a href="#tracks" class="btn btn-gradient">
                استعرض المسارات
                <i class="ti ti-list-details ms-1"></i>
              </a>

              <a href="#about" class="btn btn-outline-soft">
                تعرف على المشروع
              </a>
            </div>

            <div class="hero-stats">
              <div class="hero-stat">
                <strong>8</strong>
                <span>مسارات تدريبية</span>
              </div>

              <div class="hero-stat">
                <strong>1000</strong>
                <span>فرصة تدريب مباشرة</span>
              </div>

              <div class="hero-stat">
                <strong>130</strong>
                <span>ساعة تدريبية لكل متدرب</span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="hero-visual">
            <div class="visual-card">
              <img src="{{ asset('main-image.jpeg') }}" alt="مجموعة متدربين يعملون معاً في جلسة تدريبية">

              <div class="visual-floating">
                <div class="floating-row">
                  <span class="floating-icon">
                    <i class="ti ti-chart-dots-3"></i>
                  </span>
                  <div>
                    <h3 class="h4 mb-1 fw-black">رحلة تدريبية واضحة</h3>
                    <p class="mb-0 text-muted">اختر مسارك، قدّم طلبك، ودع فريق المشروع يراجع طلبك بعدالة وشفافية.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="about-section section-padding" id="about">
    <div class="container">
      <div class="section-heading">
        <span class="section-kicker">
          <i class="ti ti-info-circle"></i>
          عن المشروع
        </span>
        <h2 class="section-title">تمكين اقتصادي يستجيب لواقع غزة ويبني مسارات دخل مستدامة</h2>
        <p class="section-description">
          مشروع تدريبي وتنموي يستهدف الفئات الأشد ضعفًا وذوي الإعاقة، ويربط التدريب المهني والتقني باحتياجات السوق وفرص التشغيل الفعلية.
        </p>
      </div>

      <div class="row g-4 align-items-stretch">
        <div class="col-lg-7">
          <article class="about-story-card h-100">
            <h3>استجابة عملية لأزمة إنسانية واقتصادية غير مسبوقة</h3>
            <p class="about-lead">
              يشهد قطاع غزة أزمة إنسانية واقتصادية غير مسبوقة نتيجة النزاع المستمر وما خلّفه من دمار واسع في البنية التحتية، وانهيار شبه كامل لسبل العيش، وارتفاع غير مسبوق في معدلات البطالة والفقر.
            </p>
            <p>
              وتشير التقديرات الحديثة إلى أن أكثر من 90% من الأسر تعيش تحت خط الفقر، مع فقدان مئات الآلاف من الأفراد لمصادر دخلهم، وتضرر القطاعات الإنتاجية والخدمية بشكل حاد، الأمر الذي فاقم من هشاشة الفئات الأشد ضعفًا، لا سيما الشباب، النساء، والأشخاص ذوي الإعاقة.
            </p>

            <div class="about-stat-strip">
              <div class="about-stat-pill">
                <strong>90%+</strong>
                <span>من الأسر تحت خط الفقر وفق التقديرات الحديثة</span>
              </div>
              <div class="about-stat-pill">
                <strong>1,000</strong>
                <span>مستفيد مباشر من الفئات الأشد ضعفًا وذوي الإعاقة</span>
              </div>
              <div class="about-stat-pill">
                <strong>12</strong>
                <span>شهرًا تشمل التحضير والتنفيذ والمتابعة وقياس الأثر</span>
              </div>
            </div>

            <p>
              استجابةً لهذه الأوضاع الحرجة، سيقوم المركز السعودي للثقافة والتراث، الجهة المنفذة والشريك التنفيذي لمركز الملك سلمان للإغاثة والأعمال الإنسانية، بتنفيذ مشروع "التمكين الاقتصادي للفئات الأشد ضعفًا وذوي الإعاقة في قطاع غزة" ضمن إطار قطاع التعافي المبكر وتحسين سبل العيش.
            </p>
            <div class="d-flex flex-wrap gap-3 mt-4">
              <a href="#tracks" class="btn btn-gradient">استكشف المسارات</a>
              <a href="#how" class="btn btn-outline-soft">كيف تبدأ؟</a>
            </div>
          </article>
        </div>

        <div class="col-lg-5">
          <div class="row g-4 h-100">
            <div class="col-md-6 col-lg-12">
              <div class="about-mini-card">
                <div class="icon-box">
                  <i class="ti ti-heart-handshake"></i>
                </div>
                <h4>هدف تنموي واضح</h4>
                <p>دعم التعافي الاقتصادي وبناء قدرات الفئات المستهدفة وتعزيز قدرتها على الصمود عبر فرص تدريب مهني وتقني نوعية مرتبطة بمصادر دخل حقيقية ومستدامة.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-12">
              <div class="about-mini-card">
                <div class="icon-box icon-gold">
                  <i class="ti ti-tool"></i>
                </div>
                <h4>من التدريب إلى التشغيل</h4>
                <p>يشمل المشروع تزويد المستفيدين بحقيبة أدوات المهنة الأساسية، وتنفيذ أنشطة تشغيل تجريبي، ودعم ربطهم بالأسواق المحلية والرقمية.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row g-4 mt-1">
        <div class="col-lg-4">
          <div class="about-flow-card">
            <div class="icon-box icon-blue">
              <i class="ti ti-route"></i>
            </div>
            <h4>ثمانية مسارات مدروسة</h4>
            <p>برامج تدريب مهني وتقني متكاملة تم اختيارها بناءً على احتياجات السوق المحلي، وإمكانيات العمل من المنزل أو في بيئات منخفضة المخاطر.</p>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="about-flow-card">
            <div class="icon-box icon-purple">
              <i class="ti ti-users"></i>
            </div>
            <h4>مراعاة خصوصية المستفيدين</h4>
            <p>يراعي المشروع احتياجات الفئات الأشد ضعفًا، خاصة الشباب والنساء والأشخاص ذوي الإعاقة، من خلال مجموعات تدريبية منظمة ومعايير متابعة واضحة.</p>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="about-flow-card">
            <div class="icon-box">
              <i class="ti ti-chart-arrows-vertical"></i>
            </div>
            <h4>أثر قابل للقياس</h4>
            <p>لا يقتصر النهج على التدريب النظري، بل يركز على بناء مسارات اقتصادية قابلة للاستمرار مع متابعة وقياس أثر خلال مراحل التنفيذ.</p>
          </div>
        </div>
      </div>

      <div class="about-focus-list">
        <div class="about-focus-item">
          <i class="ti ti-shield-check"></i>
          <div>
            <h4>حوكمة وشفافية</h4>
            <p>يلتزم المشروع بمعايير مركز الملك سلمان للإغاثة والأعمال الإنسانية في الحوكمة، والشفافية، والمتابعة والتقييم.</p>
          </div>
        </div>

        <div class="about-focus-item">
          <i class="ti ti-flag-heart"></i>
          <div>
            <h4>دور إنساني وتنموي</h4>
            <p>يعكس المشروع الدور الإنساني والتنموي الرائد للمملكة العربية السعودية في دعم الشعب الفلسطيني وتعزيز صموده.</p>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- <section class="features-section section-padding" id="features">
    <div class="container">
      <div class="section-heading">
        <span class="section-kicker">
          <i class="ti ti-stars"></i>
          ميزات تنافسية
        </span>
        <h2 class="section-title">تجربة تقديم ذكية تبني الثقة وتسهّل القرار</h2>
        <p class="section-description">
          صُممت البوابة لتكون واضحة للمتقدم، وغنية بالبيانات لفريق الإدارة، وقادرة على دعم قرارات الاختيار بثقة وشفافية.
        </p>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="feature-card">
            <div class="icon-box">
              <i class="ti ti-forms"></i>
            </div>
            <h3>نماذج مخصصة لكل مسار</h3>
            <p>كل مسار يمتلك أسئلة ومعايير تقييم خاصة به، حتى يتم قياس الملاءمة الحقيقية للمتقدم.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="feature-card">
            <div class="icon-box icon-blue">
              <i class="ti ti-shield-check"></i>
            </div>
            <h3>تقديم منظم وآمن</h3>
            <p>تقليل التكرار، حفظ البيانات، رفع المرفقات، وربط كل طلب بمساره بشكل واضح.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="feature-card">
            <div class="icon-box icon-purple">
              <i class="ti ti-filter-check"></i>
            </div>
            <h3>فرز ذكي وشفاف</h3>
            <p>قواعد أهلية ونقاط تساعد على ترتيب الطلبات وتحديد الأولويات بطريقة عادلة.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="feature-card">
            <div class="icon-box icon-gold">
              <i class="ti ti-accessible"></i>
            </div>
            <h3>مراعاة ذوي الإعاقة</h3>
            <p>يدعم المشروع رصد الحالات الصحية واحتياجات المتقدمين ضمن عملية المراجعة.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="feature-card">
            <div class="icon-box">
              <i class="ti ti-chart-infographic"></i>
            </div>
            <h3>تقارير وتحليلات</h3>
            <p>متابعة عدد الطلبات، المقاعد، المقبولين، قوائم الانتظار، وتوزيع المتقدمين.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="feature-card">
            <div class="icon-box icon-blue">
              <i class="ti ti-device-mobile"></i>
            </div>
            <h3>تجربة متجاوبة</h3>
            <p>واجهة سلسة على الهاتف والحاسوب، لتسهيل التقديم من أي جهاز وفي أي وقت.</p>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <section class="tracks-section section-padding" id="tracks">
    <div class="container">
      <div class="section-heading">
        <span class="section-kicker">
          <i class="ti ti-list-details"></i>
          المسارات المتاحة
        </span>
        <h2 class="section-title">ثمانية مسارات مختارة بعناية لسوق العمل</h2>
        <p class="section-description">
          تجمع المسارات بين التدريب المهني والحرفي، والتدريب التقني والرقمي، لتوفير خيارات تناسب قدرات واهتمامات مختلفة.
        </p>
      </div>

      @if($tracks->isNotEmpty())
        @php
          $trackIcons = ['ti-scissors', 'ti-brush', 'ti-needle-thread', 'ti-diamond', 'ti-palette', 'ti-speakerphone', 'ti-device-laptop', 'ti-language'];
          $trackIconColors = ['', 'icon-gold', '', 'icon-purple', 'icon-blue'];
          $genderLabels = [
              'male' => 'ذكور فقط',
              'female' => 'إناث فقط',
              'both' => 'الجميع',
          ];
        @endphp

        @foreach($tracks->groupBy(fn($track) => $track->category?->name ?: 'مسارات أخرى') as $categoryName => $categoryTracks)
          <div class="track-group-title">
            <span>{{ $categoryName }}</span>
          </div>

          <div class="row g-4 mb-5">
            @foreach($categoryTracks as $track)
              <div class="col-md-6 col-lg-3">
                <article class="track-card {{ $track->type?->name && str_contains($track->type->name, 'رقمي') ? 'digital' : '' }}">
                  <div class="icon-box {{ $trackIconColors[$loop->index % count($trackIconColors)] }}">
                    <i class="ti {{ $trackIcons[$loop->index % count($trackIcons)] }}"></i>
                  </div>

                  <h3>{{ $track->title }}</h3>
                  <p>{{ \Illuminate\Support\Str::limit(strip_tags($track->short_description ?: $track->description), 150) }}</p>

                  <div class="track-meta">
                    @if($track->seats)
                      <span>{{ $track->seats }} مقعد</span>
                    @endif

                    @if($track->gender)
                      <span>{{ $genderLabels[$track->gender] ?? $track->gender }}</span>
                    @endif

                    @if($track->min_age || $track->max_age)
                      <span>{{ $track->min_age ?? '-' }}-{{ $track->max_age ?? '-' }} سنة</span>
                    @endif

                    @if($track->type)
                      <span>{{ $track->type->name }}</span>
                    @endif
                  </div>

                  <ul class="track-list">
                    @if($track->start_date)
                      <li>بداية التدريب: {{ $track->start_date->format('Y-m-d') }}</li>
                    @endif

                    @if($track->end_date)
                      <li>نهاية التدريب: {{ $track->end_date->format('Y-m-d') }}</li>
                    @endif

                    @if($track->registration_end)
                      <li>آخر موعد للتسجيل: {{ $track->registration_end->format('Y-m-d') }}</li>
                    @endif

                    @unless($track->start_date || $track->end_date || $track->registration_end)
                      <li>{{ \Illuminate\Support\Str::limit(strip_tags($track->description ?: $track->short_description), 95) }}</li>
                    @endunless
                  </ul>

                  <div class="d-grid gap-2">
                    <a href="{{ route('public.tracks.apply', $track) }}" class="btn btn-gradient">التقديم الآن</a>
                  </div>
                </article>
              </div>
            @endforeach
          </div>
        @endforeach
      @else

      <div class="track-group-title">
        <span>المسارات المهنية والحرفية</span>
      </div>

      <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
          <article class="track-card">
            <div class="icon-box">
              <i class="ti ti-scissors"></i>
            </div>
            <h3>الحلاقة الرجالية</h3>
            <p>تدريب عملي على الحلاقة والعناية بالمظهر الرجالي، مع التركيز على المهارة والتعامل المهني.</p>
            <div class="track-meta">
              <span>200 مقعد</span>
              <span>ذكور فقط</span>
              <span>18-49 سنة</span>
            </div>
            <ul class="track-list">
              <li>مدة التدريب: 130 ساعة</li>
              <li>مكان التدريب: دير البلح</li>
              <li>مناسب لمحبي العمل الخدمي والمهني</li>
            </ul>
            <div class="d-grid gap-2">
              <a href="/tracks/barber/apply" class="btn btn-gradient">التقديم الآن</a>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-lg-3">
          <article class="track-card">
            <div class="icon-box icon-gold">
              <i class="ti ti-brush"></i>
            </div>
            <h3>التجميل النسائي</h3>
            <p>تدريب في تصفيف الشعر، القصات، الصبغات، واستخدام أدوات التجميل بأسلوب احترافي.</p>
            <div class="track-meta">
              <span>200 مقعد</span>
              <span>إناث فقط</span>
              <span>18-49 سنة</span>
            </div>
            <ul class="track-list">
              <li>مدة التدريب: 130 ساعة</li>
              <li>مكان التدريب: دير البلح</li>
              <li>مناسب لمن يمتلكن ذوقاً وحساً جمالياً</li>
            </ul>
            <div class="d-grid gap-2">
              <a href="/tracks/beauty/apply" class="btn btn-gradient">التقديم الآن</a>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-lg-3">
          <article class="track-card">
            <div class="icon-box">
              <i class="ti ti-needle-thread"></i>
            </div>
            <h3>التطريز</h3>
            <p>مسار يركز على التطريز، التحكم بالإبرة والخيط، الدقة، وتتبع النماذج الفنية.</p>
            <div class="track-meta">
              <span>200 مقعد</span>
              <span>إناث فقط</span>
              <span>18-60 سنة</span>
            </div>
            <ul class="track-list">
              <li>مدة التدريب: 130 ساعة</li>
              <li>مكان التدريب: دير البلح</li>
              <li>مناسب للعمل من المنزل والمشاريع الصغيرة</li>
            </ul>
            <div class="d-grid gap-2">
              <a href="/tracks/embroidery/apply" class="btn btn-gradient">التقديم الآن</a>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-lg-3">
          <article class="track-card">
            <div class="icon-box icon-purple">
              <i class="ti ti-diamond"></i>
            </div>
            <h3>الإكسسوارات والأشغال اليدوية</h3>
            <p>تدريب على تصميم الإكسسوارات، استخدام الخرز والأسلاك، والعمل على التفاصيل الدقيقة.</p>
            <div class="track-meta">
              <span>200 مقعد</span>
              <span>إناث فقط</span>
              <span>18-60 سنة</span>
            </div>
            <ul class="track-list">
              <li>مدة التدريب: 130 ساعة</li>
              <li>مكان التدريب: دير البلح</li>
              <li>مناسب لصاحبات الحس الإبداعي واليدوي</li>
            </ul>
            <div class="d-grid gap-2">
              <a href="/tracks/accessories/apply" class="btn btn-gradient">التقديم الآن</a>
            </div>
          </article>
        </div>
      </div>

      <div class="track-group-title">
        <span>المسارات التقنية والرقمية</span>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <article class="track-card digital">
            <div class="icon-box icon-blue">
              <i class="ti ti-palette"></i>
            </div>
            <h3>التصميم الجرافيكي</h3>
            <p>تدريب على تصميم الشعارات، الإعلانات، المواد المرئية، وأدوات التصميم الرقمي.</p>
            <div class="track-meta">
              <span>50 مقعد</span>
              <span>الجميع</span>
              <span>بكالوريوس فأعلى</span>
            </div>
            <ul class="track-list">
              <li>أدوات مثل Figma وPhotoshop وIllustrator</li>
              <li>مناسب للعمل الحر والخدمات الرقمية</li>
              <li>مكان التدريب: دير البلح</li>
            </ul>
            <div class="d-grid gap-2">
              <a href="/tracks/graphic-design/apply" class="btn btn-gradient">التقديم الآن</a>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-lg-3">
          <article class="track-card digital">
            <div class="icon-box icon-blue">
              <i class="ti ti-speakerphone"></i>
            </div>
            <h3>التسويق الرقمي</h3>
            <p>تدريب على الحملات الرقمية، إدارة المحتوى، التحليل، والإعلانات عبر المنصات.</p>
            <div class="track-meta">
              <span>50 مقعد</span>
              <span>الجميع</span>
              <span>بكالوريوس فأعلى</span>
            </div>
            <ul class="track-list">
              <li>أدوات مثل Google Ads وMeta Ads</li>
              <li>مناسب لإدارة الحملات والمشاريع الرقمية</li>
              <li>مكان التدريب: دير البلح</li>
            </ul>
            <div class="d-grid gap-2">
              <a href="/tracks/digital-marketing/apply" class="btn btn-gradient">التقديم الآن</a>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-lg-3">
          <article class="track-card digital">
            <div class="icon-box icon-blue">
              <i class="ti ti-device-laptop"></i>
            </div>
            <h3>المساعد الافتراضي</h3>
            <p>تدريب على إدارة الأعمال عن بعد، التنظيم، البريد الإلكتروني، والاجتماعات الرقمية.</p>
            <div class="track-meta">
              <span>50 مقعد</span>
              <span>الجميع</span>
              <span>بكالوريوس فأعلى</span>
            </div>
            <ul class="track-list">
              <li>أدوات مثل Trello وZoom وGoogle Meet</li>
              <li>مناسب للعمل الإداري عن بعد</li>
              <li>مكان التدريب: دير البلح</li>
            </ul>
            <div class="d-grid gap-2">
              <a href="/tracks/virtual-assistant/apply" class="btn btn-gradient">التقديم الآن</a>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-lg-3">
          <article class="track-card digital">
            <div class="icon-box icon-blue">
              <i class="ti ti-language"></i>
            </div>
            <h3>الترجمة والعمل الحر</h3>
            <p>تدريب على الترجمة، منصات العمل الحر، التواصل مع العملاء، وإدارة المهام الرقمية.</p>
            <div class="track-meta">
              <span>50 مقعد</span>
              <span>الجميع</span>
              <span>بكالوريوس فأعلى</span>
            </div>
            <ul class="track-list">
              <li>منصات مثل Upwork وFiverr وFreelancer</li>
              <li>مناسب لأصحاب اللغة الإنجليزية الجيدة</li>
              <li>مكان التدريب: دير البلح</li>
            </ul>
            <div class="d-grid gap-2">
              <a href="/tracks/translation-freelance/apply" class="btn btn-gradient">التقديم الآن</a>
            </div>
          </article>
        </div>
      </div>

      @endif

    </div>
  </section>

  <section class="how-section section-padding" id="how">
    <div class="container">
      <div class="section-heading">
        <span class="section-kicker">
          <i class="ti ti-route"></i>
          كيف تبدأ؟
        </span>
        <h2 class="section-title">رحلة بسيطة من الاهتمام إلى التقديم</h2>
        <p class="section-description">
          صممنا الخطوات لتكون واضحة، سريعة، ومناسبة للمستخدمين على جميع الأجهزة.
        </p>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="step-card">
            <div class="step-number">1</div>
            <h3>استعرض المسارات</h3>
            <p>اقرأ تفاصيل كل مسار، الفئة المناسبة، عدد المقاعد، ومتطلبات التقديم.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="step-card">
            <div class="step-number">2</div>
            <h3>اختر المسار الأنسب</h3>
            <p>حدد المسار الأقرب لاهتمامك وقدرتك وفرصتك في الاستفادة منه.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="step-card">
            <div class="step-number">3</div>
            <h3>أرسل طلبك</h3>
            <p>املأ النموذج، أرفق الوثائق المطلوبة، واحصل على رقم طلب للمتابعة.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="step-card">
            <div class="step-number">4</div>
            <h3>انتظر المراجعة</h3>
            <p>تراجع الإدارة الطلبات بناءً على الأهلية والاحتياج ومعايير كل مسار.</p>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- <section class="cta-section section-padding">
    <div class="container">
      <div class="cta-card">
        <div class="row align-items-center position-relative" style="z-index:2;">
          <div class="col-lg-8">
            <h2 class="fw-black mb-3">ابدأ رحلتك نحو مهارة قابلة للتشغيل</h2>
            <p class="mb-0 opacity-75 fs-3">
              استعرض المسارات المتاحة، اختر الأنسب لك، وقدّم طلبك إلكترونياً خلال دقائق.
            </p>
          </div>

          <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
            <a href="/tracks" class="btn btn-light btn-lg rounded-pill fw-bold px-4">
              عرض كل المسارات
              <i class="ti ti-arrow-left ms-1"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section> -->

</main>

<footer class="footer">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="d-flex align-items-center gap-2 mb-3">
          <span class="brand-logo">
            <img src="https://ksach.org/frontend/assets/images/logos/full_logo_color01.png" alt="المركز السعودي للثقافة والتراث">
          </span>
          <h3 class="mb-0 text-white fw-black"> تمكين</h3>
        </div>
        <p class="mb-0">
          بوابة تعريفية وتسويقية للمسارات التدريبية ضمن مشروع التمكين الاقتصادي، تساعد الزائر على فهم المشروع واختيار المسار المناسب.
        </p>
      </div>

      <div class="col-lg-2 col-md-4">
        <h4>روابط سريعة</h4>
        <div class="d-grid">
          <a href="#about">عن المشروع</a>
          <a href="#tracks">المسارات</a>
          <a href="#how">كيف تبدأ؟</a>
        </div>
      </div>

      <div class="col-lg-3 col-md-4">
        
      </div>

    
    </div>

    <hr class="border-secondary my-4">

    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
      <div>© 2026  التمكين. جميع الحقوق محفوظة.</div>
      <div>
      
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>

<script>
  const navbar = document.querySelector('.navbar');

  window.addEventListener('scroll', function () {
    if (window.scrollY > 20) {
      navbar.style.background = 'rgba(255,255,255,.96)';
      navbar.style.boxShadow = '0 16px 45px rgba(15,23,42,.10)';
    } else {
      navbar.style.background = 'rgba(255,255,255,.88)';
      navbar.style.boxShadow = '0 12px 40px rgba(15,23,42,.06)';
    }
  });
</script>

</body>
</html>
