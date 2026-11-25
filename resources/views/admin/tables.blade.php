
@extends('admin.layout')

@section('title', 'Meja & QR')

@section('content')
<style>
    /* =========================================
       CHOGO COFFEE - TABLE MANAGEMENT
    ========================================= */

    main.content:has(.tables-page) {
        max-width: none;
        padding: 28px 32px;
    }

    .tables-page {
        max-width: 1500px;
        margin: auto;
        color: #38291f;
    }

    .tables-page * {
        box-sizing: border-box;
    }

    /* HEADER */

    .tables-eyebrow {
        margin: 0 0 8px;
        color: #7b796a;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .13em;
        text-transform: uppercase;
    }

    .tables-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .tables-head h1 {
        margin: 0;
        font: 700 clamp(24px, 3vw, 32px)/1.2 Georgia, serif;
        color: #34251d;
    }

    .tables-head p:last-child {
        max-width: 650px;
        margin: 8px 0 0;
        color: #81776d;
        font-size: 13px;
        line-height: 1.6;
    }

    .tables-head-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 10px;
    }

    .tables-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 44px;
        padding: 0 18px;
        border: 1px solid #76513a;
        border-radius: 999px;
        background: #76513a;
        color: white;
        text-decoration: none;
        font: 650 13px system-ui, sans-serif;
        transition: .2s ease;
    }

    .tables-primary:hover {
        background: #503622;
        color: white;
        transform: translateY(-1px);
    }

    /* STATISTICS */

    .tables-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 24px;
    }

    .tables-stat {
        background: #fff;
        border: 1px solid #f0e8df;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 18px rgba(82, 53, 34, .035);
    }

    .tables-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .tables-stat-label {
        color: #75685f;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .tables-stat-icon {
        display: grid;
        place-items: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #fbefe3;
        color: #76513a;
        font-size: 17px;
        flex-shrink: 0;
    }

    .tables-stat:nth-child(2) .tables-stat-icon {
        background: #e0e8d5;
        color: #59694f;
    }

    .tables-stat:nth-child(3) .tables-stat-icon {
        background: #f9e1d3;
        color: #9b5428;
    }

    .tables-stat-value {
        display: flex;
        align-items: baseline;
        gap: 8px;
        margin-top: 10px;
        font: 700 34px/1.1 Georgia, serif;
        color: #38291f;
    }

    .tables-stat-value small {
        color: #96877b;
        font: 500 13px system-ui, sans-serif;
    }

    .tables-stat-note {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px dashed #eee4d9;
        color: #887d72;
        font-size: 11px;
        line-height: 1.5;
    }

    /* MAIN LAYOUT */

    .tables-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(320px, 360px);
        gap: 24px;
        align-items: start;
    }

    .tables-list-section {
        min-width: 0;
    }

    .tables-list-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }

    .tables-list-head h2 {
        margin: 0;
        font: 700 20px Georgia, serif;
        color: #38291f;
    }

    .tables-list-head span {
        color: #8c7d70;
        font-size: 12px;
    }

    /* SEARCH */

    .tables-search-wrap {
        position: relative;
        margin-bottom: 16px;
    }

    .tables-search-icon {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #8c7d70;
        pointer-events: none;
    }

    .tables-search {
        width: 100%;
        min-height: 46px;
        margin: 0;
        padding: 0 15px 0 42px;
        border: 1px solid #eee3d8;
        border-radius: 999px;
        background: #fff;
        color: #38291f;
        font: inherit;
        font-size: 13px;
        transition: .2s;
    }

    .tables-search:focus {
        outline: none;
        border-color: #8a654a;
        box-shadow: 0 0 0 3px rgba(138, 101, 74, .1);
    }

    .tables-search::placeholder {
        color: #a39487;
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    /* TABLE GRID */

    .tables-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .table-card {
        min-width: 0;
        padding: 18px;
        background: #fff;
        border: 1px solid #f0e8df;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(82, 53, 34, .035);
        transition: .2s ease;
    }

    .table-card:hover {
        border-color: #b99a80;
        box-shadow: 0 8px 24px rgba(82, 53, 34, .07);
        transform: translateY(-2px);
    }

    .table-card[hidden] {
        display: none !important;
    }

    .table-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }

    .table-card-number {
        color: #998777;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .table-card h3 {
        margin: 5px 0 0;
        font: 700 20px Georgia, serif;
        color: #38291f;
        overflow-wrap: anywhere;
    }

    .table-card-description {
        margin-top: 5px;
        color: #8c7d70;
        font-size: 11px;
    }

    .table-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        color: #56684c;
        background: #e0e8d5;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .table-status::before {
        content: "●";
        font-size: 8px;
    }

    .table-qr-token {
        margin-top: 16px;
        padding: 12px;
        color: #796758;
        background: #fbf3ea;
        border: 1px solid #f5e7d8;
        border-radius: 10px;
        font: 11px/1.5 ui-monospace, monospace;
        overflow-wrap: anywhere;
    }

    .table-qr-token strong {
        display: block;
        margin-bottom: 4px;
        color: #8c7d70;
        font: 700 10px system-ui, sans-serif;
        text-transform: uppercase;
        letter-spacing: .07em;
    }

    .table-card-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px solid #f1e8df;
    }

    .table-card-actions a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 7px 12px;
        color: #76513a;
        background: #fbf1e8;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 650;
        transition: .2s;
    }

    .table-card-actions a:hover {
        background: #76513a;
        color: white;
    }

    .tables-empty {
        grid-column: 1 / -1;
        padding: 32px 20px;
        color: #8c7d70;
        background: #fff;
        border: 1px dashed #dfd0c0;
        border-radius: 14px;
        text-align: center;
        font-size: 13px;
    }

    .tables-empty[hidden] {
        display: none !important;
    }

    /* =========================================
       PREVIEW TENT CARD - REFINED DESIGN
    ========================================= */

    .tables-preview {
        position: sticky;
        top: 20px;
        width: 100%;
        min-width: 0;
    }

    .tables-preview-card {
        display: block !important;
        width: 100%;
        min-width: 0;
        padding: 22px;
        background: #fff;
        border: 1px solid #eee5dc;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(70, 45, 30, .045);
        overflow: hidden;
    }

    /* PREVIEW HEADER */

    .tables-preview-header {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f0e8df;
    }

    .tables-preview-title-wrap {
        display: flex;
        flex-direction: row;
        align-items: center;
        flex: 1 1 180px;
        min-width: 0;
        gap: 10px;
    }

    .tables-preview-title-icon {
        display: grid;
        place-items: center;
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        color: #76513a;
        background: #f8eee3;
        border-radius: 10px;
    }

    .tables-preview-title-wrap h2 {
        margin: 0;
        font: 700 16px/1.4 Georgia, serif;
        color: #38291f;
        white-space: normal;
        overflow-wrap: normal;
        word-break: normal;
    }

    .tables-preview-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        flex-shrink: 0;
        padding: 6px 9px;
        color: #56684c;
        background: #e5ecd9;
        border-radius: 999px;
        font-size: 9px;
        font-weight: 700;
        white-space: nowrap;
    }

    .tables-preview-subtitle {
        display: block;
        margin: 10px 0 18px;
        color: #8c7d70;
        font-size: 11px;
        line-height: 1.6;
    }

    /* TENT CARD */

    .tent-card {
        position: relative;
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 24px 20px 18px;
        background: #f8f3e9;
        border: 1px solid #e9ddcc;
        border-radius: 16px;
        text-align: center;
        overflow: hidden;
    }

    .tent-card::before,
    .tent-card::after {
        content: "";
        position: absolute;
        width: 110px;
        height: 110px;
        border: 1px solid rgba(118, 81, 58, .07);
        border-radius: 50%;
        pointer-events: none;
    }

    .tent-card::before {
        top: -60px;
        right: -45px;
    }

    .tent-card::after {
        bottom: -65px;
        left: -45px;
    }

    /* BRAND */

    .tent-brand-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
    }

    .tent-brand {
        color: #76513a;
        font: italic 700 20px Georgia, serif;
        letter-spacing: -.02em;
    }

    .tent-brand-caption {
        color: #a08b77;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: .18em;
        text-transform: uppercase;
    }

    .tent-divider {
        width: 42px;
        height: 1px;
        margin: 16px auto 0;
        background: #d7c5b2;
    }

    /* TABLE NUMBER */

    .tent-number-wrap {
        margin-top: 15px;
    }

    .tent-number-label {
        display: block;
        color: #9b8571;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .tent-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 8px 0 0;
        padding: 9px 17px;
        color: #fff;
        background: #76513a;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
    }

    /* MAIN MESSAGE */

    .tent-card h3 {
        margin: 20px 0 0;
        color: #38291f;
        font: 700 23px/1.3 Georgia, serif;
        letter-spacing: -.025em;
    }

    .tent-description {
        max-width: 250px;
        margin: 8px auto 0;
        color: #81776d;
        font-size: 11px;
        line-height: 1.7;
    }

    /* QR FRAME */

    .tent-qr-frame {
        position: relative;
        display: grid;
        place-items: center;
        width: min(100%, 210px);
        aspect-ratio: 1;
        margin: 22px auto;
        padding: 13px;
        background: #fff;
        border: 1px solid #ece3d9;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(80, 50, 30, .07);
    }

    .tent-qr {
        display: grid;
        place-items: center;
        width: 100%;
        height: 100%;
    }

    .tent-qr svg {
        display: block;
        width: 100%;
        height: 100%;
    }

    /* STEPS */

    .tent-steps {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
        margin-top: 16px;
    }

    .tent-step {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
        min-width: 0;
        padding: 10px 8px;
        background: rgba(255, 255, 255, .7);
        border: 1px solid #eae0d4;
        border-radius: 10px;
        text-align: left;
    }

    .tent-step-number {
        display: grid;
        place-items: center;
        width: 22px;
        height: 22px;
        color: #fff;
        background: #76513a;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 700;
    }

    .tent-step-text {
        color: #746457;
        font-size: 9px;
        line-height: 1.5;
    }

    /* WIFI */

    .tent-wifi {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-top: 12px;
        padding: 10px 12px;
        background: #fff;
        border: 1px solid #ece3d9;
        border-radius: 10px;
        text-align: left;
    }

    .tent-wifi-label {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #75685f;
        font-size: 10px;
        font-weight: 700;
    }

    .tent-wifi-label-icon {
        color: #76513a;
    }

    .tent-wifi-value {
        color: #8c7d70;
        font-size: 9px;
        overflow-wrap: anywhere;
    }

    /* DISCLAIMER */

    .tent-disclaimer {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        margin: 12px 0 0;
        color: #938477;
        font-size: 10px;
        line-height: 1.6;
    }

    .tent-disclaimer-icon {
        flex-shrink: 0;
    }

    /* SYSTEM NOTE */

    .tables-preview-note {
        width: 100%;
        margin-top: 16px;
        padding: 14px;
        background: #fcf7f1;
        border: 1px solid #f0e4d7;
        border-radius: 12px;
    }

    .tables-preview-note-title {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 6px;
        color: #76513a;
        font-size: 11px;
        font-weight: 700;
    }

    .tables-preview-note p {
        margin: 0;
        color: #8c7d70;
        font-size: 10px;
        line-height: 1.7;
    }

    /* PAGINATION */

    .pagination {
        margin-top: 20px;
    }

    /* =========================================
       RESPONSIVE
    ========================================= */

    /* LARGE DESKTOP */
    @media (min-width: 1200px) {
        .tables-layout {
            grid-template-columns: minmax(0, 1fr) 360px;
            gap: 24px;
        }

        .tables-preview-card {
            padding: 22px;
        }
    }

    /* LAPTOP */
    @media (max-width: 1199px) and (min-width: 1001px) {
        main.content:has(.tables-page) {
            padding: 24px;
        }

        .tables-layout {
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 16px;
        }

        .tables-preview-card {
            padding: 16px;
        }

        .tables-preview-title-wrap {
            flex-basis: 160px;
        }
    }

    /* TABLET */
    @media (max-width: 1000px) {
        .tables-layout {
            grid-template-columns: minmax(0, 1fr);
        }

        .tables-preview {
            position: static;
        }

        .tables-preview-card {
            display: block !important;
            width: 100%;
        }

        .tent-card {
            max-width: 460px;
            margin: 0 auto;
        }

        .tables-preview-note {
            max-width: none;
        }
    }

    /* MOBILE */
    @media (max-width: 700px) {
        main.content:has(.tables-page) {
            padding: 20px 16px;
        }

        .tables-head {
            align-items: flex-start;
            flex-direction: column;
        }

        .tables-head-actions {
            width: 100%;
            justify-content: stretch;
        }

        .tables-primary {
            flex: 1;
        }

        .tables-stats {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .tables-stat {
            padding: 16px;
        }

        .tables-stat-value {
            font-size: 28px;
        }

        .tables-grid {
            grid-template-columns: 1fr;
        }

        .tables-preview-card {
            padding: 16px !important;
        }

        .tables-preview-header {
            flex-wrap: wrap;
            align-items: center;
        }

        .tables-preview-title-wrap {
            flex: 1 1 100%;
        }

        .tables-preview-title-wrap h2 {
            font-size: 16px;
        }

        .tables-preview-badge {
            margin-top: 2px;
        }

        .tent-card {
            padding: 22px 14px;
        }

        .tent-brand {
            font-size: 18px;
        }

        .tent-card h3 {
            font-size: 21px;
        }

        .tent-qr-frame {
            width: min(100%, 190px);
        }

        .tent-steps {
            grid-template-columns: 1fr;
        }

        .tent-step {
            flex-direction: row;
            align-items: center;
        }

        .tent-step-text {
            font-size: 10px;
        }

        .tables-preview-note {
            margin-top: 16px;
        }
    }

    /* SMALL MOBILE */
    @media (max-width: 400px) {
        main.content:has(.tables-page) {
            padding: 16px 12px;
        }

        .tables-head h1 {
            font-size: 24px;
        }

        .tables-list-head h2 {
            font-size: 18px;
        }

        .table-card {
            padding: 14px;
        }

        .table-card-actions {
            flex-wrap: wrap;
        }

        .table-card-actions a {
            flex: 1;
        }

        .tables-preview-card {
            padding: 15px !important;
        }

        .tent-card {
            padding: 20px 14px;
        }
    }
</style>

<div class="tables-page">

    {{-- HEADER --}}
    <header class="tables-head">
        <div>
            <p class="tables-eyebrow">
                Katalog &amp; resto operasional · Dine-in order portal
            </p>

            <h1>Manajemen Meja &amp; QR</h1>

            <p>
                Kelola nomor meja dan token QR untuk membantu
                tamu membuka alur pemesanan.
            </p>
        </div>

        <div class="tables-head-actions">
            <a class="tables-primary"
               href="{{ route('admin.tables.create') }}">
                <span>＋</span>
                Tambah Meja Baru
            </a>
        </div>
    </header>

    {{-- STATISTIK --}}
    <section class="tables-stats" aria-label="Ringkasan meja">

        <article class="tables-stat">
            <div class="tables-stat-top">
                <div class="tables-stat-label">Total Meja</div>
                <div class="tables-stat-icon">♧</div>
            </div>

            <div class="tables-stat-value">
                {{ $tables->total() }}
                <small>Meja</small>
            </div>

            <div class="tables-stat-note">
                Jumlah meja yang tercatat di sistem.
            </div>
        </article>

        <article class="tables-stat">
            <div class="tables-stat-top">
                <div class="tables-stat-label">Token Meja</div>
                <div class="tables-stat-icon">♙</div>
            </div>

            <div class="tables-stat-value">
                {{ $tables->total() }}
                <small>Tersimpan</small>
            </div>

            <div class="tables-stat-note">
                Token tersedia sebagai identitas meja di sistem.
            </div>
        </article>

        <article class="tables-stat">
            <div class="tables-stat-top">
                <div class="tables-stat-label">Informasi Okupansi</div>
                <div class="tables-stat-icon">⌑</div>
            </div>

            <div class="tables-stat-value">
                —
                <small>Belum tersedia</small>
            </div>

            <div class="tables-stat-note">
                Status sesi dan kapasitas belum tersedia di sistem.
            </div>
        </article>

    </section>

    {{-- MAIN --}}
    <div class="tables-layout">

        {{-- DAFTAR MEJA --}}
        <section class="tables-list-section"
                 aria-labelledby="tables-list-title">

            <div class="tables-list-head">
                <h2 id="tables-list-title">Daftar Meja</h2>
                <span>{{ $tables->total() }} meja</span>
            </div>

            {{-- SEARCH --}}
            <label class="sr-only" for="tables-search">
                Cari nomor meja di halaman ini
            </label>

            <div class="tables-search-wrap">
                <span class="tables-search-icon">⌕</span>

                <input
                    class="tables-search"
                    id="tables-search"
                    type="search"
                    placeholder="Cari nomor meja di halaman ini…"
                    aria-describedby="tables-search-help"
                >
            </div>

            <span class="sr-only" id="tables-search-help">
                Pencarian hanya mencakup meja pada halaman saat ini.
            </span>

            {{-- CARD MEJA --}}
            <div class="tables-grid" id="tables-grid">

                @forelse ($tables as $table)

                    <article class="table-card"
                             data-table-number="{{ strtolower($table->nomor_meja) }}">

                        <div class="table-card-top">
                            <div>
                                <div class="table-card-number">
                                    ID Meja {{ $table->id_meja }}
                                </div>

                                <h3>{{ $table->nomor_meja }}</h3>

                                <div class="table-card-description">
                                    Identitas meja
                                </div>
                            </div>

                            <span class="table-status">
                                Terdaftar
                            </span>
                        </div>

                        <div class="table-qr-token">
                            <strong>Token QR Meja</strong>
                            {{ $table->kode_qr }}
                        </div>

                        <div class="table-card-actions">
                            <a href="{{ route('admin.tables.edit', $table) }}">
                                Ubah Meja
                            </a>

                            <a href="{{ route('admin.tables.edit', $table) }}"
                               aria-label="Kelola meja {{ $table->nomor_meja }}">
                                Kelola →
                            </a>
                        </div>

                    </article>

                @empty

                    <div class="tables-empty">
                        Belum ada meja. Tambahkan meja untuk mulai menyiapkan QR.
                    </div>

                @endforelse

                <p class="tables-empty"
                   id="tables-no-results"
                   hidden>
                    Tidak ada meja yang cocok dengan pencarian.
                </p>

            </div>

            {{-- PAGINATION --}}
            <div class="pagination">
                {{ $tables->links() }}
            </div>

        </section>

        {{-- PREVIEW QR --}}
        <aside class="tables-preview"
               aria-label="Pratinjau QR meja">

            <section class="tables-preview-card">

                {{-- HEADER PREVIEW --}}
                <div class="tables-preview-header">

                    <div class="tables-preview-title-wrap">
                        <div class="tables-preview-title-icon">
                            <span>▧</span>
                        </div>

                        <h2>Preview Tent Card QR</h2>
                    </div>

                    <span class="tables-preview-badge">
                        ● Konsep
                    </span>

                </div>

                <p class="tables-preview-subtitle">
                    Pratinjau desain kartu meja untuk dine-in
                </p>

                {{-- TENT CARD --}}
                <div class="tent-card">

                    {{-- BRAND --}}
                    <div class="tent-brand-wrap">

                        <div class="tent-brand">
                            Chōgō Kōhi
                        </div>

                        <span class="tent-brand-caption">
                            Coffee &amp; Slow Living
                        </span>

                    </div>

                    <div class="tent-divider"></div>

                    {{-- TABLE NUMBER --}}
                    <div class="tent-number-wrap">

                        <span class="tent-number-label">
                            Welcome to your table
                        </span>

                        <span class="tent-number">
                            NOMOR MEJA
                        </span>

                    </div>

                    {{-- MAIN TEXT --}}
                    <h3>
                        Scan untuk<br>melihat menu
                    </h3>

                    <p class="tent-description">
                        Nikmati pengalaman memesan menu favorit
                        dengan mudah melalui QR Code meja.
                    </p>

                    {{-- QR --}}
                    <div class="tent-qr-frame">

                        <div class="tent-qr" aria-hidden="true">

                            <svg viewBox="0 0 21 21"
                                 xmlns="http://www.w3.org/2000/svg">

                                <rect width="21" height="21" fill="#fff"/>

                                <path fill="#76513a"
                                    d="
                                    M0 0h7v7H0z
                                    M2 2v3h3V2z

                                    M14 0h7v7h-7z
                                    M16 2v3h3V2z

                                    M0 14h7v7H0z
                                    M2 16v3h3v-3z

                                    M9 0h2v2H9z
                                    M9 4h2v2H9z
                                    M8 8h3v3H8z
                                    M12 8h2v2h-2z
                                    M15 8h2v3h-2z
                                    M18 9h2v2h-2z

                                    M8 13h2v2H8z
                                    M11 13h3v2h-3z
                                    M15 13h2v2h-2z
                                    M18 13h3v2h-3z

                                    M9 16h2v2H9z
                                    M12 17h2v2h-2z
                                    M15 16h3v3h-3z
                                    M19 18h2v2h-2z
                                    "/>

                            </svg>

                        </div>

                    </div>

                    {{-- INSTRUCTIONS --}}
                    <div class="tent-steps">

                        <div class="tent-step">
                            <span class="tent-step-number">1</span>

                            <span class="tent-step-text">
                                Buka kamera dan scan QR
                            </span>
                        </div>

                        <div class="tent-step">
                            <span class="tent-step-number">2</span>

                            <span class="tent-step-text">
                                Pilih menu dan catatan
                            </span>
                        </div>

                        <div class="tent-step">
                            <span class="tent-step-number">3</span>

                            <span class="tent-step-text">
                                Pesan dan bayar
                            </span>
                        </div>

                    </div>

                    {{-- WIFI --}}
                    <div class="tent-wifi">

                        <div class="tent-wifi-label">
                            <span class="tent-wifi-label-icon">⌁</span>
                            WiFi Guest
                        </div>

                        <span class="tent-wifi-value">
                            Informasi WiFi kedai
                        </span>

                    </div>

                </div>

                {{-- DISCLAIMER --}}
                <p class="tent-disclaimer">
                    <span class="tent-disclaimer-icon">ⓘ</span>

                    <span>
                        QR di atas hanya ilustrasi desain dan belum
                        dapat dipindai.
                    </span>
                </p>

                {{-- SYSTEM NOTE --}}
                <div class="tables-preview-note">

                    <div class="tables-preview-note-title">
                        <span>ⓘ</span>
                        Informasi sistem
                    </div>

                    <p>
                        Preview ini merupakan konsep visual.
                        Fitur QR aktif, cetak tent card, kapasitas,
                        area, dan status penggunaan meja belum
                        terintegrasi dengan sistem.
                    </p>

                </div>

            </section>

        </aside>

    </div>

</div>

{{-- SEARCH SCRIPT --}}
<script>
    const tableSearch = document.querySelector('#tables-search');

    tableSearch?.addEventListener('input', (event) => {
        const query = event.target.value.trim().toLowerCase();
        let visibleCount = 0;

        document.querySelectorAll('[data-table-number]').forEach((card) => {
            const matches = card.dataset.tableNumber.includes(query);

            card.hidden = !matches;
            visibleCount += Number(matches);
        });

        document.querySelector('#tables-no-results').hidden =
            visibleCount > 0 || query === '';
    });
</script>
@endsection
