@extends('layouts.app')

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Qurban 1446 H — Semua Bisa Berqurban | Berkahin</title>
<meta name="description" content="Tunaikan ibadah qurban bersama Berkahin. Hewan berkualitas, tersertifikasi halal, disalurkan ke 38 provinsi Indonesia."/>
<meta property="og:title" content="Qurban 1446 H — Semua Bisa Berqurban | Berkahin"/>
<meta property="og:description" content="Tunaikan ibadah qurban bersama Berkahin. Hewan berkualitas, tersertifikasi halal, disalurkan ke 38 provinsi Indonesia."/>
<meta property="og:image" content="https://images.unsplash.com/photo-1609599006353-e629aaabfeae?w=1200&q=80"/>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --grn:       #1a6b4a;
  --grn-dk:    #144f37;
  --grn-lt:    #e8f4ee;
  --grn-pale:  #f2faf6;
  --grn-border:#b3d9c4;
  --gold:      #c9922a;
  --gold-lt:   #fef3e2;
  --text:      #1a1a18;
  --text-md:   #3d3d38;
  --text-muted:#6b7068;
  --text-hint: #9ca39a;
  --surface:   #ffffff;
  --bg:        #f5f4f0;
  --border:    #e4e3dd;
  --radius:    16px;
  --radius-sm: 10px;
  --serif:     'Playfair Display', Georgia, serif;
  --sans:      'DM Sans', system-ui, sans-serif;
  --nav-h:     68px;
  --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.04);
  --shadow-md: 0 2px 8px rgba(0,0,0,0.08), 0 12px 32px rgba(0,0,0,0.06);
}

html { scroll-behavior: smooth; }

body {
  font-family: var(--sans);
  background: var(--bg);
  color: var(--text);
  line-height: 1.6;
  min-height: 100vh;
}


/* HERO */
.hero {
  position: relative;
  height: 480px;
  overflow: hidden;
}
.hero-img {
  width: 100%; height: 100%; object-fit: cover;
  transform: scale(1.03);
  transition: transform 8s ease;
}
.hero-img.loaded { transform: scale(1); }
.hero-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(
    to bottom,
    rgba(10,30,20,0.2) 0%,
    rgba(10,30,20,0.15) 30%,
    rgba(10,30,20,0.7) 75%,
    rgba(10,30,20,0.92) 100%
  );
}
.hero-content {
  position: absolute; bottom: 0; left: 0; right: 0;
  padding: 0 28px 36px;
  max-width: 760px; margin: 0 auto;
}
.hero-content-inner { max-width: 680px; }

.badge-row {
  display: flex; align-items: center; gap: 8px;
  margin-bottom: 16px;
}
.badge {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 4px 12px; border-radius: 20px;
  font-size: 11px; font-weight: 600;
  letter-spacing: 0.3px;
}
.badge-grn {
  background: rgba(255,255,255,0.15);
  color: white;
  border: 1px solid rgba(255,255,255,0.25);
  backdrop-filter: blur(4px);
}
.badge-gold {
  background: var(--gold);
  color: white;
}
.badge-dot {
  width: 5px; height: 5px; border-radius: 50%;
  background: #4ade80; flex-shrink: 0;
}

.hero-title {
  font-family: var(--serif);
  font-size: clamp(26px, 4vw, 44px);
  font-weight: 700;
  color: white;
  line-height: 1.2;
  margin-bottom: 12px;
  letter-spacing: -0.5px;
}
.hero-title em {
  font-style: italic;
  color: #86efac;
}
.hero-sub {
  font-size: 15px;
  color: rgba(255,255,255,0.78);
  line-height: 1.6;
  max-width: 480px;
}

/* MAIN LAYOUT — single column */
.main-wrap {
  max-width: 760px;
  margin: 0 auto;
  padding: 40px 28px 100px;
  display: flex;
  flex-direction: column;
  gap: 24px;
}

/* Progress card */
.prog-card {
  background: var(--surface);
  border-radius: var(--radius);
  border: 1px solid var(--border);
  padding: 24px;
  box-shadow: var(--shadow-sm);
}
.prog-org-row {
  display: flex; align-items: center; gap: 10px;
  margin-bottom: 18px;
}
.prog-org-av {
  width: 36px; height: 36px; border-radius: 50%;
  background: var(--grn-lt);
  display: flex; align-items: center; justify-content: center;
  font-size: 12px; font-weight: 600; color: var(--grn); flex-shrink: 0;
  border: 1px solid var(--grn-border);
}
.prog-org-name { font-size: 13px; color: var(--text-muted); }
.prog-org-badge {
  display: inline-flex; align-items: center; gap: 4px;
  font-size: 11px; color: var(--grn);
  background: var(--grn-lt); padding: 2px 8px;
  border-radius: 20px; margin-left: 4px;
  border: 1px solid var(--grn-border);
}

.prog-title {
  font-size: 17px; font-weight: 600;
  color: var(--text); line-height: 1.4;
  margin-bottom: 20px;
}

.prog-nums {
  display: flex; justify-content: space-between;
  align-items: baseline; margin-bottom: 10px;
}
.prog-collected {
  font-size: 22px; font-weight: 600;
  color: var(--grn); letter-spacing: -0.5px;
}
.prog-target { font-size: 13px; color: var(--text-muted); }

.prog-track {
  height: 9px; background: var(--bg);
  border-radius: 9px; overflow: hidden;
  border: 1px solid var(--border);
}
.prog-fill {
  height: 100%; border-radius: 9px;
  background: linear-gradient(90deg, var(--grn) 0%, #2d9a6a 100%);
  width: 0%; transition: width 1.2s cubic-bezier(0.34,1,0.64,1);
}

.prog-meta {
  display: flex; gap: 20px; margin-top: 12px;
  flex-wrap: wrap;
}
.prog-meta-item { font-size: 12px; color: var(--text-muted); }
.prog-meta-item strong { color: var(--text); font-weight: 600; }
.prog-urgent {
  display: flex; align-items: center; gap: 5px;
  font-size: 12px; color: #dc2626; font-weight: 600;
}
.prog-urgent::before {
  content: '';
  width: 6px; height: 6px; border-radius: 50%;
  background: #dc2626;
  animation: blink 1.2s ease-in-out infinite;
}
@keyframes blink {
  0%,100% { opacity: 1; }
  50% { opacity: 0.3; }
}

/* Tabs */
.info-card {
  background: var(--surface);
  border-radius: var(--radius);
  border: 1px solid var(--border);
  overflow: hidden;
  box-shadow: var(--shadow-sm);
}
.tabs-row {
  display: flex;
  border-bottom: 1px solid var(--border);
  padding: 0 20px;
  gap: 4px;
  background: #fafaf8;
}
.tab-btn {
  padding: 12px 14px;
  font-size: 13px; font-weight: 500;
  color: var(--text-muted); cursor: pointer;
  background: none; border: none;
  border-bottom: 2px solid transparent;
  margin-bottom: -1px;
  font-family: var(--sans);
  transition: color 0.15s;
}
.tab-btn:hover { color: var(--grn); }
.tab-btn.on {
  color: var(--grn);
  border-bottom-color: var(--grn);
  font-weight: 600;
}
.tab-pane { display: none; padding: 24px; }
.tab-pane.on { display: block; }

.desc-text {
  font-size: 14px; line-height: 1.85;
  color: var(--text-md);
}
.desc-text p { margin-bottom: 14px; }
.desc-text p:last-child { margin-bottom: 0; }

.quote-block {
  background: var(--grn-pale);
  border-left: 3px solid var(--grn);
  padding: 14px 18px;
  border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
  font-family: var(--serif);
  font-style: italic;
  color: var(--grn-dk);
  font-size: 14px; line-height: 1.7;
  margin: 18px 0;
}

.keutamaan-list { list-style: none; margin-top: 14px; }
.keutamaan-list li {
  display: flex; align-items: center; gap: 12px;
  padding: 10px 0;
  font-size: 14px; color: var(--text-md);
  border-bottom: 1px solid var(--border);
}
.keutamaan-list li:last-child { border: none; }
.k-num {
  width: 26px; height: 26px; border-radius: 50%;
  background: var(--grn); color: white;
  display: flex; align-items: center; justify-content: center;
  font-size: 11px; font-weight: 700; flex-shrink: 0;
}

/* Donatur tab */
.donatur-list { display: flex; flex-direction: column; }
.donatur-item {
  display: flex; align-items: center; gap: 12px;
  padding: 12px 0;
  border-bottom: 1px solid var(--border);
}
.donatur-item:last-child { border: none; }
.donatur-av {
  width: 38px; height: 38px; border-radius: 50%;
  background: var(--grn-lt);
  display: flex; align-items: center; justify-content: center;
  font-size: 11px; font-weight: 700; color: var(--grn); flex-shrink: 0;
  border: 1px solid var(--grn-border);
}
.donatur-name { font-size: 14px; font-weight: 600; }
.donatur-msg { font-size: 12px; color: var(--text-muted); margin-top: 2px; font-style: italic; }
.donatur-amt { font-size: 13px; font-weight: 600; color: var(--grn); white-space: nowrap; }
.donatur-time { font-size: 11px; color: var(--text-hint); margin-top: 2px; }

/* Deadline card */
.deadline-card {
  background: var(--gold-lt);
  border: 1px solid #fde68a;
  border-radius: var(--radius-sm);
  padding: 14px 16px;
  display: flex; align-items: flex-start; gap: 12px;
}
.deadline-icon { font-size: 20px; flex-shrink: 0; margin-top: 1px; }
.deadline-text { font-size: 13px; color: #92400e; line-height: 1.6; }
.deadline-text strong { display: block; font-weight: 600; margin-bottom: 2px; color: #78350f; }

/* CTA card */
.cta-card {
  background: var(--surface);
  border-radius: var(--radius);
  border: 1px solid var(--border);
  overflow: hidden;
  box-shadow: var(--shadow-md);
}
.cta-card-head {
  padding: 18px 20px;
  background: linear-gradient(135deg, var(--grn) 0%, #2d8a60 100%);
  position: relative; overflow: hidden;
}
.cta-card-head::before {
  content: '';
  position: absolute; right: -30px; top: -30px;
  width: 120px; height: 120px; border-radius: 50%;
  background: rgba(255,255,255,0.06);
  pointer-events: none;
}
.cta-head-label { font-size: 11px; color: rgba(255,255,255,0.65); font-weight: 500; letter-spacing: 0.3px; margin-bottom: 4px; }
.cta-head-price { font-size: 28px; font-weight: 700; color: white; letter-spacing: -0.5px; }
.cta-head-from { font-size: 12px; color: rgba(255,255,255,0.65); margin-top: 2px; }

.cta-body {
  padding: 16px 20px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0;
}

.cta-info-row {
  display: flex; align-items: center; gap: 8px;
  padding: 10px 0;
  border-bottom: 1px solid var(--border);
  font-size: 13px;
}
.cta-info-row:nth-child(odd)  { padding-right: 16px; border-right: 1px solid var(--border); }
.cta-info-row:nth-child(even) { padding-left: 16px; }
.cta-info-row:nth-last-child(-n+2) { border-bottom: none; }

.cta-info-icon {
  width: 28px; height: 28px; border-radius: 7px;
  background: var(--grn-lt);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.cta-info-lbl { color: var(--text-muted); flex: 1; font-size: 12px; }
.cta-info-val { font-weight: 600; color: var(--text); font-size: 12px; white-space: nowrap; }

.cta-btns { padding: 16px 20px; display: flex; flex-direction: column; gap: 10px; border-top: 1px solid var(--border); }

.btn-donasi {
  width: 100%; padding: 15px;
  background: var(--grn); color: white;
  border: none; border-radius: var(--radius-sm);
  font-size: 16px; font-weight: 600;
  font-family: var(--sans); cursor: pointer;
  display: flex; align-items: center; justify-content: center; gap: 10px;
  transition: background 0.15s, transform 0.12s, box-shadow 0.15s;
  text-decoration: none;
  box-shadow: 0 2px 8px rgba(26,107,74,0.25);
}
.btn-donasi:hover {
  background: var(--grn-dk);
  transform: translateY(-1px);
  box-shadow: 0 4px 16px rgba(26,107,74,0.3);
}
.btn-donasi:active { transform: translateY(0); }

.btn-share {
  width: 100%; padding: 12px;
  background: transparent; color: var(--text-muted);
  border: 1px solid var(--border); border-radius: var(--radius-sm);
  font-size: 14px; font-weight: 500;
  font-family: var(--sans); cursor: pointer;
  display: flex; align-items: center; justify-content: center; gap: 8px;
  transition: all 0.15s; text-decoration: none;
}
.btn-share:hover {
  border-color: var(--grn);
  color: var(--grn);
  background: var(--grn-lt);
}

/* Share popup */
.share-popup {
  display: none; position: relative;
  background: var(--surface); border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  padding: 14px 16px;
  margin: 0 20px 16px;
  box-shadow: var(--shadow-sm);
}
.share-popup.show { display: block; }
.share-popup-title { font-size: 12px; font-weight: 600; color: var(--text-muted); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.3px; }
.share-options { display: flex; gap: 8px; flex-wrap: wrap; }
.share-opt {
  display: flex; align-items: center; gap: 7px;
  padding: 8px 14px; border-radius: 8px;
  font-size: 13px; font-weight: 500; cursor: pointer;
  border: none; font-family: var(--sans);
  transition: opacity 0.15s;
}
.share-opt:hover { opacity: 0.85; }
.share-opt-wa  { background: #25D366; color: white; }
.share-opt-tw  { background: #1da1f2; color: white; }
.share-opt-lnk { background: var(--bg); color: var(--text-md); border: 1px solid var(--border); }
.copy-toast {
  display: none; position: fixed; bottom: 28px; left: 50%; transform: translateX(-50%);
  background: var(--text); color: white;
  padding: 10px 20px; border-radius: 8px;
  font-size: 13px; font-weight: 500;
  z-index: 999; box-shadow: var(--shadow-md);
  animation: slideUp 0.2s ease;
}
.copy-toast.show { display: block; }
@keyframes slideUp { from { opacity:0; transform: translateX(-50%) translateY(8px); } to { opacity:1; transform: translateX(-50%) translateY(0); } }

.trust-badges {
  display: flex; justify-content: center; gap: 20px;
  padding: 14px 16px;
  border-top: 1px solid var(--border);
}
.trust-item {
  display: flex; align-items: center; gap: 5px;
  font-size: 11px; color: var(--text-muted);
}

/* FORM VIEW */
#formView { display: none; }

.form-back-row {
  display: flex; align-items: center; gap: 8px;
  margin-bottom: 24px; cursor: pointer;
  color: var(--grn); font-size: 14px; font-weight: 500;
  transition: opacity 0.15s;
  user-select: none;
}
.form-back-row:hover { opacity: 0.75; }

.form-stepper {
  display: flex; border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  overflow: hidden; margin-bottom: 24px;
}
.fstep {
  flex: 1; padding: 13px 8px; text-align: center;
  font-size: 12px; color: var(--text-muted);
  background: var(--bg); font-weight: 400;
  border-right: 1px solid var(--border);
  transition: background 0.2s;
}
.fstep:last-child { border-right: none; }
.fstep.act { background: var(--grn-lt); color: var(--grn); font-weight: 600; }
.fstep.done { background: #f0faf5; color: var(--grn); }
.fstep-num {
  width: 22px; height: 22px; border-radius: 50%;
  background: var(--border); color: var(--text-muted);
  font-size: 11px; font-weight: 600;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 3px;
  transition: background 0.2s, color 0.2s;
}
.fstep.act .fstep-num  { background: var(--grn); color: white; }
.fstep.done .fstep-num { background: var(--grn); color: white; }

.fpanel { display: none; }
.fpanel.on { display: block; }

.fcard {
  background: var(--surface);
  border-radius: var(--radius);
  border: 1px solid var(--border);
  overflow: hidden;
  box-shadow: var(--shadow-sm);
  margin-bottom: 16px;
}
.fcard-head {
  padding: 16px 20px;
  border-bottom: 1px solid var(--border);
  background: #fafaf8;
}
.fcard-head h3 { font-size: 15px; font-weight: 600; margin-bottom: 2px; }
.fcard-head p  { font-size: 12px; color: var(--text-muted); }

.sec-lbl {
  padding: 9px 20px 7px;
  font-size: 11px; font-weight: 600; letter-spacing: 0.5px;
  text-transform: uppercase; color: var(--text-muted);
  background: #fafaf8; border-bottom: 1px solid var(--border);
  border-top: 1px solid var(--border);
}

.hewan-grid { display: grid; grid-template-columns: 1fr 1fr; }
.hewan-opt {
  padding: 14px 12px; cursor: pointer; position: relative;
  border-right: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
  transition: background 0.12s;
}
.hewan-opt:nth-child(2n) { border-right: none; }
.hewan-opt:nth-last-child(-n+2) { border-bottom: none; }
.hewan-opt:hover { background: var(--grn-lt); }
.hewan-opt.sel { background: var(--grn-lt); }
.hewan-opt.sel::after {
  content: '';
  position: absolute; top: 9px; right: 9px;
  width: 17px; height: 17px; border-radius: 50%;
  background: var(--grn);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath d='M4 8l3 3 5-5' stroke='white' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
  background-size: cover;
}
.h-emoji { font-size: 22px; margin-bottom: 5px; display: block; }
.h-nm    { font-size: 12px; font-weight: 600; color: var(--text); }
.h-kg    { font-size: 11px; color: var(--text-hint); margin-top: 1px; }
.h-pr    { font-size: 14px; font-weight: 700; color: var(--grn); margin-top: 5px; }

.qty-row {
  display: flex; align-items: center; justify-content: space-between;
  padding: 13px 20px; border-bottom: 1px solid var(--border);
}
.qty-lbl { font-size: 13px; color: var(--text-muted); }
.qty-ctrl { display: flex; align-items: center; gap: 14px; }
.qty-btn {
  width: 30px; height: 30px; border-radius: 50%;
  border: 1px solid var(--border); background: var(--surface);
  font-size: 19px; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  color: var(--text); transition: all 0.12s; line-height: 1;
  font-family: var(--sans);
}
.qty-btn:hover { background: var(--grn-lt); border-color: var(--grn); color: var(--grn); }
.qty-num { font-size: 16px; font-weight: 600; min-width: 24px; text-align: center; }

.total-prev {
  display: flex; justify-content: space-between; align-items: center;
  padding: 13px 20px; background: var(--grn-lt);
  border-bottom: 1px solid var(--grn-border);
}
.total-prev-lbl { font-size: 13px; color: var(--text-muted); }
.total-prev-val { font-size: 20px; font-weight: 700; color: var(--grn); letter-spacing: -0.3px; }

.fg { padding: 13px 20px; border-bottom: 1px solid var(--border); }
.fl {
  display: block; font-size: 11px; font-weight: 600;
  color: var(--text-muted); margin-bottom: 6px;
  text-transform: uppercase; letter-spacing: 0.3px;
}
.fi {
  width: 100%; border: 1px solid var(--border);
  border-radius: var(--radius-sm); padding: 10px 13px;
  font-size: 14px; font-family: var(--sans);
  background: var(--surface); color: var(--text);
  outline: none; transition: border-color 0.15s;
  box-sizing: border-box;
}
.fi:focus { border-color: var(--grn); box-shadow: 0 0 0 3px rgba(26,107,74,0.08); }
.fi.err { border-color: #dc2626; }
.ferr { font-size: 11px; color: #dc2626; margin-top: 5px; display: none; }
.ferr.show { display: block; }

.chips { display: flex; gap: 6px; flex-wrap: wrap; }
.chip {
  padding: 5px 13px; border-radius: 20px;
  border: 1px solid var(--border); background: var(--surface);
  font-size: 12px; cursor: pointer; color: var(--text-muted);
  font-family: var(--sans); transition: all 0.12s;
}
.chip:hover { border-color: var(--grn); color: var(--grn); }
.chip.on { background: var(--grn-lt); border-color: var(--grn); color: var(--grn); font-weight: 600; }

.anon-row {
  display: flex; align-items: center; gap: 12px;
  padding: 13px 20px; cursor: pointer;
  border-bottom: 1px solid var(--border);
}
.tog {
  width: 40px; height: 22px; border-radius: 11px;
  background: #d1d5db; position: relative; transition: background 0.2s; flex-shrink: 0;
}
.tog.on { background: var(--grn); }
.tog::after {
  content: ''; position: absolute;
  width: 16px; height: 16px; background: white; border-radius: 50%;
  top: 3px; left: 3px; transition: left 0.18s;
  box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}
.tog.on::after { left: 21px; }
.anon-lbl { font-size: 13px; color: var(--text-muted); }

.form-cta { padding: 16px 20px; display: flex; flex-direction: column; gap: 9px; border-top: 1px solid var(--border); }

.btn-next {
  width: 100%; padding: 14px;
  background: var(--grn); color: white;
  border: none; border-radius: var(--radius-sm);
  font-size: 15px; font-weight: 600; font-family: var(--sans);
  cursor: pointer; display: flex; align-items: center;
  justify-content: center; gap: 9px; transition: background 0.15s;
}
.btn-next:hover { background: var(--grn-dk); }

.btn-back-sm {
  width: 100%; padding: 11px;
  background: transparent; color: var(--text-muted);
  border: 1px solid var(--border); border-radius: var(--radius-sm);
  font-size: 13px; font-weight: 500; font-family: var(--sans);
  cursor: pointer; display: flex; align-items: center;
  justify-content: center; gap: 6px; transition: all 0.15s;
}
.btn-back-sm:hover { border-color: var(--grn); color: var(--grn); background: var(--grn-lt); }

/* Pembayaran */
.ord-sum {
  padding: 16px 20px;
  background: var(--grn-lt);
  border-bottom: 1px solid var(--grn-border);
}
.ord-sum-title {
  font-size: 11px; font-weight: 600;
  text-transform: uppercase; letter-spacing: 0.4px;
  color: var(--text-muted); margin-bottom: 10px;
}
.ord-row { display: flex; justify-content: space-between; font-size: 13px; padding: 4px 0; }
.ord-row .l { color: var(--text-muted); }
.ord-row .v { font-weight: 600; }
.ord-total { display: flex; justify-content: space-between; font-size: 15px; padding: 10px 0 0; border-top: 1px solid var(--grn-border); margin-top: 8px; }
.ord-total .l { font-weight: 600; }
.ord-total .v { font-weight: 700; color: var(--grn); font-size: 19px; }

.pay-sec-lbl {
  padding: 8px 20px 7px;
  font-size: 11px; font-weight: 600; letter-spacing: 0.5px;
  text-transform: uppercase; color: var(--text-muted);
  border-bottom: 1px solid var(--border);
}
.pay-sec-lbl + .pay-sec-lbl,
.pay-opt + .pay-sec-lbl { border-top: 1px solid var(--border); margin-top: 4px; }

.pay-opt {
  display: flex; align-items: center; gap: 12px;
  padding: 12px 20px; border-bottom: 1px solid var(--border);
  cursor: pointer; transition: background 0.12s;
}
.pay-opt:hover { background: #fafaf8; }
.pay-opt.on { background: var(--grn-lt); }
.pay-logo {
  width: 48px; height: 28px; border-radius: 6px;
  border: 1px solid var(--border);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; overflow: hidden; background: white;
}
.pay-info { flex: 1; }
.pay-nm { font-size: 13px; font-weight: 600; }
.pay-ds { font-size: 11px; color: var(--text-muted); margin-top: 1px; }
.radio {
  width: 17px; height: 17px; border-radius: 50%;
  border: 1.5px solid var(--border); flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  transition: all 0.12s;
}
.pay-opt.on .radio { border-color: var(--grn); background: var(--grn); }
.pay-opt.on .radio::after { content: ''; width: 5px; height: 5px; background: white; border-radius: 50%; }

.pay-detail { display: none; background: #f9faf8; border-top: 1px solid var(--border); padding: 18px 20px; }
.pay-detail.show { display: block; }
.qris-center { text-align: center; }
.qris-frame {
  width: 150px; height: 150px; margin: 0 auto 12px;
  background: white; border: 1px solid var(--border);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
}
.qris-timer { font-size: 11px; color: var(--text-muted); background: white; border: 1px solid var(--border); border-radius: 20px; padding: 3px 12px; display: inline-block; margin-bottom: 8px; }
.ew-center { text-align: center; }
.ew-logo { width: 50px; height: 50px; border-radius: 50%; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; }
.ew-phone { font-size: 19px; font-weight: 700; letter-spacing: 0.5px; }
.ew-holder { font-size: 12px; color: var(--text-muted); margin-top: 2px; margin-bottom: 12px; }
.bank-norek {
  background: white; border: 1px solid var(--border);
  border-radius: 9px; padding: 10px 13px; margin-bottom: 9px;
}
.bank-norek .lbl { font-size: 11px; color: var(--text-muted); margin-bottom: 3px; }
.bank-norek .val { font-size: 15px; font-weight: 700; display: flex; align-items: center; justify-content: space-between; }
.copy-btn {
  font-size: 11px; color: var(--grn); background: var(--grn-lt);
  border: none; padding: 4px 10px; border-radius: 7px;
  cursor: pointer; font-family: var(--sans); font-weight: 600;
}
.copy-btn:hover { background: var(--grn-border); }
.bank-note { font-size: 11px; color: var(--text-muted); line-height: 1.7; }
.bank-note strong { color: var(--text); }

.btn-confirm {
  width: 100%; padding: 14px;
  background: var(--grn); color: white;
  border: none; border-radius: var(--radius-sm);
  font-size: 15px; font-weight: 600; font-family: var(--sans);
  cursor: pointer; display: flex; align-items: center;
  justify-content: center; gap: 9px; transition: background 0.15s;
}
.btn-confirm:hover { background: var(--grn-dk); }

.wa-help {
  display: flex; align-items: center; justify-content: center; gap: 6px;
  font-size: 12px; color: #25D366; text-decoration: none;
  padding: 0 20px 14px; transition: opacity 0.15s;
}
.wa-help:hover { opacity: 0.8; }

/* Sukses */
.sukses-wrap { padding: 36px 24px; text-align: center; }
.sukses-sparkle { font-size: 30px; margin-bottom: 6px; animation: fadeUp 0.5s ease 0.2s both; }
.sukses-icon {
  width: 72px; height: 72px; border-radius: 50%;
  background: var(--grn); margin: 0 auto 20px;
  display: flex; align-items: center; justify-content: center;
  animation: popIn 0.5s cubic-bezier(0.34,1.56,0.64,1);
}
@keyframes popIn { from { opacity:0; transform:scale(0.5); } to { opacity:1; transform:scale(1); } }
@keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
.sukses-title {
  font-family: var(--serif); font-size: 22px; font-weight: 700;
  margin-bottom: 8px; animation: fadeUp 0.5s ease 0.3s both;
}
.sukses-sub {
  font-size: 14px; color: var(--text-muted); line-height: 1.7;
  max-width: 320px; margin: 0 auto 22px;
  animation: fadeUp 0.5s ease 0.4s both;
}
.sukses-detail {
  background: var(--bg); border-radius: 10px;
  border: 1px solid var(--border);
  padding: 16px; text-align: left; margin-bottom: 20px;
  animation: fadeUp 0.5s ease 0.5s both;
}
.sukses-detail-title { font-size: 11px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 12px; }
.sukses-row { display: flex; justify-content: space-between; font-size: 13px; padding: 6px 0; border-bottom: 1px solid var(--border); }
.sukses-row:last-child { border: none; }
.sukses-row .l { color: var(--text-muted); }
.sukses-row .v { font-weight: 600; }
.sukses-kode { font-size: 14px; color: var(--grn); font-weight: 700; font-family: monospace; letter-spacing: 0.5px; }
.sukses-notif {
  background: #fefce8; border: 1px solid #fde68a;
  border-radius: 10px; padding: 12px 14px; text-align: left;
  margin-bottom: 20px; display: flex; gap: 10px; align-items: flex-start;
  animation: fadeUp 0.5s ease 0.6s both;
}
.sukses-notif-icon { font-size: 16px; flex-shrink: 0; margin-top: 1px; }
.sukses-notif-text { font-size: 12px; color: #92400e; line-height: 1.65; }
.sukses-notif-text strong { display: block; font-weight: 700; margin-bottom: 2px; }
.sukses-btns { display: flex; flex-direction: column; gap: 9px; animation: fadeUp 0.5s ease 0.7s both; }
.btn-sk-wa {
  display: flex; align-items: center; justify-content: center; gap: 8px;
  width: 100%; padding: 13px; background: #25D366; color: white;
  border: none; border-radius: 10px; font-size: 14px; font-weight: 600;
  font-family: var(--sans); cursor: pointer; text-decoration: none; transition: opacity 0.15s;
}
.btn-sk-wa:hover { opacity: 0.88; }
.btn-sk-primary {
  display: block; width: 100%; padding: 12px;
  background: var(--grn); color: white;
  border: none; border-radius: 10px; font-size: 14px; font-weight: 600;
  font-family: var(--sans); cursor: pointer; text-align: center;
  text-decoration: none; transition: background 0.15s;
}
.btn-sk-primary:hover { background: var(--grn-dk); }
.btn-sk-ghost {
  display: block; width: 100%; padding: 11px;
  background: transparent; color: var(--grn);
  border: 1.5px solid var(--grn); border-radius: 10px;
  font-size: 13px; font-weight: 600; font-family: var(--sans);
  cursor: pointer; text-align: center; text-decoration: none;
  transition: all 0.15s;
}
.btn-sk-ghost:hover { background: var(--grn-lt); }


</style>
</head>
<body>


<!-- HERO -->
<div class="hero">
  <img
    class="hero-img"
    src="https://images.unsplash.com/photo-1609599006353-e629aaabfeae?w=1400&q=80"
    alt="Qurban 1446 H"
    onload="this.classList.add('loaded')"
    onerror="this.style.display='none'"
  />
  <div class="hero-overlay"></div>
  <div style="max-width:760px;margin:0 auto;height:100%;position:relative">
    <div class="hero-content">
      <div class="hero-content-inner">
        <div class="badge-row">
          <span class="badge badge-grn">
            <span class="badge-dot"></span>
            Qurban 1446 H
          </span>
          <span class="badge badge-gold">🔥 Promo Terbatas</span>
        </div>
        <h1 class="hero-title">
          Semua Bisa <em>Berqurban</em><br>Bersama Berkahin
        </h1>
        <p class="hero-sub">Tunaikan ibadah qurban dengan mudah. Hewan berkualitas, tersertifikasi halal, disalurkan langsung ke 38 provinsi Indonesia.</p>
      </div>
    </div>
  </div>
</div>

<!-- LANDING VIEW -->
<div id="landingView">
<div class="main-wrap">

  <!-- 1. Progress -->
  <div class="prog-card">
    <div class="prog-org-row">
      <div class="prog-org-av">B</div>
      <div>
        <span class="prog-org-name">Berkahin</span>
        <span class="prog-org-badge">
          <svg width="9" height="9" viewBox="0 0 9 9"><path d="M4.5 1L5.5 3.2L8 3.5L6.25 5.15L6.75 7.5L4.5 6.35L2.25 7.5L2.75 5.15L1 3.5L3.5 3.2Z" fill="#1a6b4a"/></svg>
          Terverifikasi
        </span>
      </div>
    </div>
    <div class="prog-title">Semua Bisa Berqurban — Promo Spesial 1446 H</div>
    <div class="prog-nums">
      <span class="prog-collected">Rp 187.500.000</span>
      <span class="prog-target">dari Rp 300.000.000</span>
    </div>
    <div class="prog-track">
      <div class="prog-fill" id="progFill"></div>
    </div>
    <div class="prog-meta">
      <div class="prog-meta-item"><strong id="progPct">0%</strong> tercapai</div>
      <div class="prog-meta-item"><strong>4</strong> donatur</div>
      <div class="prog-urgent">Segera berakhir</div>
    </div>
  </div>

  <!-- 2. Info Tabs -->
  <div class="info-card">
    <div class="tabs-row">
      <button class="tab-btn on" onclick="switchTab('keterangan', this)">Keterangan</button>
      <button class="tab-btn" onclick="switchTab('donatur', this)">Donatur (4)</button>
      <button class="tab-btn" onclick="switchTab('doa', this)">Doa</button>
    </div>

    <div class="tab-pane on" id="tab-keterangan">
      <div class="desc-text">
        <p>Berqurban adalah ibadah yang paling Allah cintai — bukti cinta dan pengorbanan kita kepada-Nya, sekaligus amalan yang mendekatkan diri kepada Allah SWT.</p>
        <div class="quote-block">
          "Sesungguhnya Allah telah memberikan karunia sangat banyak kepadamu, maka sholatlah untuk Tuhanmu, dan sembelihlah Qurban."
          <br/><em style="font-size:12px;opacity:0.8">(QS. Al Kautsar: 1–2)</em>
        </div>
        <p>Program <strong>Semua Bisa Qurban</strong> memungkinkan setiap lapisan masyarakat berqurban dengan harga terjangkau. Hewan qurban berkualitas, tersertifikasi halal, dan disalurkan langsung ke seluruh pelosok Indonesia.</p>
        <p>Setiap qurban yang Anda titipkan akan diproses oleh tim profesional kami, dengan laporan penyaluran lengkap yang dikirimkan langsung ke WhatsApp Anda.</p>
        <p style="font-weight:600;color:var(--text);margin-top:18px">Keutamaan Ibadah Qurban</p>
        <ul class="keutamaan-list">
          <li><div class="k-num">1</div>Amalan yang paling dicintai Allah SWT</li>
          <li><div class="k-num">2</div>Mendekatkan diri kepada Allah SWT</li>
          <li><div class="k-num">3</div>Bentuk ketakwaan yang nyata kepada Allah</li>
          <li><div class="k-num">4</div>Hewan qurban menjadi saksi di hari kiamat</li>
          <li><div class="k-num">5</div>Berbagi kebahagiaan dengan sesama yang membutuhkan</li>
        </ul>
      </div>
    </div>

    <div class="tab-pane" id="tab-donatur">
      <div class="donatur-list">
        <div class="donatur-item">
          <div class="donatur-av">OB</div>
          <div style="flex:1">
            <div class="donatur-name">Orang Baik</div>
            <div class="donatur-msg">Qurban atas nama ibu Warsini</div>
          </div>
          <div style="text-align:right">
            <div class="donatur-amt">Rp 1.399.000</div>
            <div class="donatur-time">2 thn lalu</div>
          </div>
        </div>
        <div class="donatur-item">
          <div class="donatur-av">IA</div>
          <div style="flex:1">
            <div class="donatur-name">Irwan Ahmadin</div>
            <div class="donatur-msg">Barakallah...</div>
          </div>
          <div style="text-align:right">
            <div class="donatur-amt">Rp 1.399.000</div>
            <div class="donatur-time">2 thn lalu</div>
          </div>
        </div>
        <div class="donatur-item">
          <div class="donatur-av">H</div>
          <div style="flex:1">
            <div class="donatur-name">Hidayat</div>
            <div class="donatur-msg">Doa diberikan kesehatan dan rejeki berkah</div>
          </div>
          <div style="text-align:right">
            <div class="donatur-amt">Rp 1.399.000</div>
            <div class="donatur-time">2 thn lalu</div>
          </div>
        </div>
        <div class="donatur-item">
          <div class="donatur-av">RS</div>
          <div style="flex:1">
            <div class="donatur-name">Rini Susanti</div>
            <div class="donatur-msg">Semoga diterima Allah SWT 🤲</div>
          </div>
          <div style="text-align:right">
            <div class="donatur-amt">Rp 2.500.000</div>
            <div class="donatur-time">2 thn lalu</div>
          </div>
        </div>
      </div>
    </div>

    <div class="tab-pane" id="tab-doa">
      <div class="donatur-list">
        <div class="donatur-item">
          <div class="donatur-av" style="background:#fef2f2;color:#991b1b;border-color:#fecaca">OB</div>
          <div>
            <div class="donatur-name">Orang Baik</div>
            <div class="donatur-msg" style="font-size:13px;margin-top:4px">Qurban atas nama ibu Warsini, semoga menjadi amal jariyah beliau.</div>
          </div>
        </div>
        <div class="donatur-item">
          <div class="donatur-av" style="background:#fef2f2;color:#991b1b;border-color:#fecaca">IA</div>
          <div>
            <div class="donatur-name">Irwan Ahmadin</div>
            <div class="donatur-msg" style="font-size:13px;margin-top:4px">Barakallah, semoga menjadi amal jariyah yang pahalanya terus mengalir.</div>
          </div>
        </div>
        <div class="donatur-item">
          <div class="donatur-av" style="background:#fef2f2;color:#991b1b;border-color:#fecaca">H</div>
          <div>
            <div class="donatur-name">Hidayat</div>
            <div class="donatur-msg" style="font-size:13px;margin-top:4px">Doa diberikan kesehatan, keselamatan, dan rejeki berkah untuk seluruh keluarga.</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 3. Deadline -->
  <div class="deadline-card">
    <div class="deadline-icon">⏳</div>
    <div class="deadline-text">
      <strong>Pendaftaran Segera Ditutup</strong>
      Program qurban 1446 H ditutup pada <strong>5 Juni 2025</strong>. Segera daftarkan qurban Anda sebelum kehabisan!
    </div>
  </div>

  <!-- 4. CTA Card -->
  <div class="cta-card">
    <div class="cta-card-head">
      <div class="cta-head-label">Mulai dari</div>
      <div class="cta-head-price">Rp 1.399.000</div>
      <div class="cta-head-from">per ekor · Kambing Afrika 23–25 kg</div>
    </div>

    <div class="cta-body">
      <div class="cta-info-row">
        <div class="cta-info-icon">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1.5C7 1.5 2.5 4.5 2.5 8C2.5 10.49 4.51 12.5 7 12.5C9.49 12.5 11.5 10.49 11.5 8C11.5 4.5 7 1.5 7 1.5Z" fill="#1a6b4a" opacity="0.8"/></svg>
        </div>
        <span class="cta-info-lbl">Hewan pilihan</span>
        <span class="cta-info-val">4 jenis</span>
      </div>
      <div class="cta-info-row">
        <div class="cta-info-icon">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1L8.5 5H13L9 7.5L10.5 12L7 9.5L3.5 12L5 7.5L1 5H5.5L7 1Z" fill="#1a6b4a" opacity="0.8"/></svg>
        </div>
        <span class="cta-info-lbl">Disalurkan ke</span>
        <span class="cta-info-val">38 provinsi</span>
      </div>
      <div class="cta-info-row">
        <div class="cta-info-icon">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1.5" y="3" width="11" height="9" rx="1.5" stroke="#1a6b4a" stroke-width="1.2"/><path d="M1.5 6h11" stroke="#1a6b4a" stroke-width="1.2"/><rect x="4" y="8" width="3" height="1.5" rx="0.5" fill="#1a6b4a"/></svg>
        </div>
        <span class="cta-info-lbl">Metode bayar</span>
        <span class="cta-info-val">Transfer &amp; QRIS</span>
      </div>
      <div class="cta-info-row">
        <div class="cta-info-icon">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1.5C3.96 1.5 1.5 3.96 1.5 7C1.5 10.04 3.96 12.5 7 12.5C10.04 12.5 12.5 10.04 12.5 7C12.5 3.96 10.04 1.5 7 1.5ZM9.5 9.5L6.5 7.5V3.5H7.5V7L10 8.5L9.5 9.5Z" fill="#1a6b4a"/></svg>
        </div>
        <span class="cta-info-lbl">Laporan via</span>
        <span class="cta-info-val">WhatsApp</span>
      </div>
    </div>

    <!-- Share popup -->
    <div class="share-popup" id="sharePopup">
      <div class="share-popup-title">Bagikan ke</div>
      <div class="share-options">
        <button class="share-opt share-opt-wa" onclick="shareWA()">
          <svg width="14" height="14" viewBox="0 0 16 16" fill="white"><path d="M8 .5C3.86.5.5 3.86.5 8c0 1.3.34 2.52.95 3.58L.5 15.5l3.99-1.05A7.5 7.5 0 1 0 8 .5zm3.9 10.6c-.16.44-.92.84-1.27.89-.32.05-.74.06-1.13-.08-.26-.09-.58-.21-.98-.39-1.71-.74-2.82-2.47-2.91-2.58-.08-.12-.7-.92-.7-1.76s.44-1.26.6-1.43c.16-.17.35-.21.46-.21.12 0 .23 0 .32.01.1.01.25-.04.39.3.16.38.54 1.32.59 1.41.05.1.08.2.01.32-.07.13-.1.2-.18.31-.1.11-.19.24-.27.33-.09.1-.17.18-.07.37.1.17.45.73.97 1.18.66.59 1.23.77 1.41.85.17.08.27.07.37-.04.11-.13.46-.54.59-.72.12-.17.25-.15.43-.09.17.07 1.11.52 1.3.62.18.09.31.14.36.22.05.08.05.52-.11.97z"/></svg>
          WhatsApp
        </button>
        <button class="share-opt share-opt-tw" onclick="shareTwitter()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="white"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          X (Twitter)
        </button>
        <button class="share-opt share-opt-lnk" onclick="copyLink()">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M5.5 8.5L8.5 5.5M6.5 3.5L7.3 2.7C8.46 1.54 10.36 1.54 11.52 2.7C12.68 3.86 12.68 5.76 11.52 6.92L10.72 7.72M7.28 6.28L3.28 10.28C2.12 11.44 2.12 13.34 3.28 14.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/><path d="M3.5 6.5L2.7 7.3C1.54 8.46 1.54 10.36 2.7 11.52" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
          Salin Link
        </button>
      </div>
    </div>

    <div class="cta-btns">
      <button class="btn-donasi" onclick="bukaDonasi()">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M9 2C9 2 4.5 5.5 4.5 9.5C4.5 12.04 6.49 14 9 14C11.51 14 13.5 12.04 13.5 9.5C13.5 5.5 9 2 9 2Z" fill="white" opacity="0.8"/></svg>
        Donasi Sekarang
      </button>
      <button class="btn-share" id="shareBtn" onclick="toggleShare()">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="12" cy="3" r="1.5" stroke="currentColor" stroke-width="1.3"/><circle cx="12" cy="13" r="1.5" stroke="currentColor" stroke-width="1.3"/><circle cx="4" cy="8" r="1.5" stroke="currentColor" stroke-width="1.3"/><path d="M10.5 3.75L5.5 7.25M5.5 8.75L10.5 12.25" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
        Bagikan Campaign
      </button>
    </div>

    <div class="trust-badges">
      <div class="trust-item">
        <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M6.5 1L8 4.5H12L9 6.75L10.5 10.5L6.5 8L2.5 10.5L4 6.75L1 4.5H5L6.5 1Z" fill="#1a6b4a"/></svg>
        <span>Terverifikasi</span>
      </div>
      <div class="trust-item">
        <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M6.5 1.5L7.8 4.7H11L8.5 6.5L9.5 9.5L6.5 7.8L3.5 9.5L4.5 6.5L2 4.7H5.2L6.5 1.5Z" stroke="#1a6b4a" stroke-width="1" fill="none"/></svg>
        <span>Halal MUI</span>
      </div>
      <div class="trust-item">
        <svg width="13" height="13" viewBox="0 0 13 13" fill="none"><rect x="1.5" y="3.5" width="10" height="7" rx="1.5" stroke="#1a6b4a" stroke-width="1"/><path d="M4 6.5h5M4 8.5h3" stroke="#1a6b4a" stroke-width="1" stroke-linecap="round"/></svg>
        <span>Laporan Lengkap</span>
      </div>
    </div>
  </div>

</div>
</div><!-- end landingView -->

<!-- FORM VIEW -->
<div id="formView">
<div class="main-wrap" style="max-width:680px">

  <div>
    <div class="form-back-row" onclick="kembaliLanding()">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Kembali ke detail program
    </div>

    <div class="form-stepper">
      <div class="fstep act" id="fsi1"><div class="fstep-num" id="fsn1">1</div>Data Donasi</div>
      <div class="fstep"     id="fsi2"><div class="fstep-num" id="fsn2">2</div>Pembayaran</div>
      <div class="fstep"     id="fsi3"><div class="fstep-num" id="fsn3">3</div>Konfirmasi</div>
    </div>

    <!-- Panel 1 -->
    <div class="fpanel on" id="fpanel1">
      <div class="fcard">
        <div class="fcard-head">
          <h3>Pilih Hewan &amp; Data Diri</h3>
          <p>Pilih hewan qurban dan lengkapi informasi Anda</p>
        </div>

        <div class="sec-lbl" style="border-top:none">Pilih hewan qurban</div>
        <div class="hewan-grid">
          <div class="hewan-opt sel" id="ho0" onclick="selHewan(0)" data-price="1399000">
            <span class="h-emoji">🐑</span>
            <div class="h-nm">Kambing Afrika</div>
            <div class="h-kg">23–25 kg</div>
            <div class="h-pr">Rp 1.399.000</div>
          </div>
          <div class="hewan-opt" id="ho1" onclick="selHewan(1)" data-price="2500000">
            <span class="h-emoji">🐏</span>
            <div class="h-nm">Domba Garut</div>
            <div class="h-kg">30–35 kg</div>
            <div class="h-pr">Rp 2.500.000</div>
          </div>
          <div class="hewan-opt" id="ho2" onclick="selHewan(2)" data-price="3500000">
            <span class="h-emoji">🐄</span>
            <div class="h-nm">Sapi 1/7 Bagian</div>
            <div class="h-kg">350–400 kg</div>
            <div class="h-pr">Rp 3.500.000</div>
          </div>
          <div class="hewan-opt" id="ho3" onclick="selHewan(3)" data-price="24500000">
            <span class="h-emoji">🐃</span>
            <div class="h-nm">Sapi Utuh</div>
            <div class="h-kg">350–400 kg</div>
            <div class="h-pr">Rp 24.500.000</div>
          </div>
        </div>

        <div class="qty-row">
          <span class="qty-lbl">Jumlah hewan</span>
          <div class="qty-ctrl">
            <button class="qty-btn" onclick="chgQty(-1)">−</button>
            <span class="qty-num" id="qtyNum">1</span>
            <button class="qty-btn" onclick="chgQty(1)">+</button>
          </div>
        </div>
        <div class="total-prev">
          <span class="total-prev-lbl">Total pembayaran</span>
          <span class="total-prev-val" id="totalVal">Rp 1.399.000</span>
        </div>

        <div class="sec-lbl">Data Diri</div>

        <div class="fg">
          <label class="fl">Sapaan</label>
          <div class="chips" id="sapChips">
            <button class="chip on" onclick="setSap(this)">Kak</button>
            <button class="chip" onclick="setSap(this)">Bunda</button>
            <button class="chip" onclick="setSap(this)">Bapak</button>
            <button class="chip" onclick="setSap(this)">Ibu</button>
            <button class="chip" onclick="setSap(this)">Ustadz</button>
          </div>
        </div>

        <div class="fg" id="namaGroup">
          <label class="fl" for="namaInput">Nama atas nama qurban <span style="color:#dc2626">*</span></label>
          <input class="fi" type="text" id="namaInput" placeholder="Masukkan nama pemberi qurban"/>
          <div class="ferr" id="namaErr">Nama wajib diisi.</div>
        </div>

        <div class="fg">
          <label class="fl" for="waInput">Nomor WhatsApp <span style="color:#dc2626">*</span></label>
          <input class="fi" type="tel" id="waInput" placeholder="08xxxxxxxxxx"/>
          <div class="ferr" id="waErr">Nomor WhatsApp wajib diisi.</div>
        </div>

        <div class="fg" style="border-bottom:none">
          <label class="fl" for="doaInput">Doa / pesan (opsional)</label>
          <textarea class="fi" id="doaInput" rows="2" style="resize:none;height:60px" placeholder="Tuliskan doa Anda..."></textarea>
        </div>

        <div class="anon-row" onclick="toggleAnon()">
          <div class="tog" id="anonTog"></div>
          <span class="anon-lbl">Sembunyikan nama saya (tampil sebagai "Orang Baik")</span>
        </div>
      </div>

      <div class="form-cta">
        <button class="btn-next" onclick="goStep2()">
          Lanjut ke Pembayaran
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </div>
    </div>

    <!-- Panel 2 -->
    <div class="fpanel" id="fpanel2">
      <div class="fcard">
        <div class="fcard-head">
          <h3>Pilih Metode Pembayaran</h3>
          <p>Selesaikan pembayaran donasi Anda</p>
        </div>

        <div class="ord-sum">
          <div class="ord-sum-title">Ringkasan Pesanan</div>
          <div class="ord-row"><span class="l">Donatur</span><span class="v" id="s2-nama">—</span></div>
          <div class="ord-row"><span class="l">Hewan</span><span class="v" id="s2-hewan">—</span></div>
          <div class="ord-row"><span class="l">Jumlah</span><span class="v" id="s2-jumlah">—</span></div>
          <div class="ord-total"><span class="l">Total</span><span class="v" id="s2-total">—</span></div>
        </div>

        <div class="pay-sec-lbl" style="margin-top:8px">Pembayaran Instan</div>
        <div class="pay-opt on" id="po-qris" onclick="selPay('qris')">
          <div class="pay-logo"><svg width="42" height="24" viewBox="0 0 42 24"><rect width="42" height="24" rx="4" fill="#fff"/><text x="4" y="16" font-size="9" font-weight="700" fill="#e21e1e" font-family="sans-serif">QRIS</text><rect x="28" y="4" width="10" height="10" rx="1" fill="#111"/><rect x="29" y="5" width="4" height="4" rx="0.5" fill="#fff"/></svg></div>
          <div class="pay-info"><div class="pay-nm">QRIS</div><div class="pay-ds">GoPay, OVO, Dana, semua dompet digital</div></div>
          <div class="radio"></div>
        </div>
        <div class="pay-opt" id="po-gopay" onclick="selPay('gopay')">
          <div class="pay-logo" style="background:#00AED6"><svg width="42" height="24" viewBox="0 0 44 22"><text x="2" y="15" font-size="11" font-weight="700" fill="white" font-family="sans-serif">GoPay</text></svg></div>
          <div class="pay-info"><div class="pay-nm">GoPay</div><div class="pay-ds">Transfer ke nomor GoPay</div></div>
          <div class="radio"></div>
        </div>
        <div class="pay-opt" id="po-ovo" onclick="selPay('ovo')">
          <div class="pay-logo" style="background:#4C3494"><svg width="42" height="24" viewBox="0 0 40 22"><text x="8" y="15" font-size="11" font-weight="700" fill="white" font-family="sans-serif">OVO</text></svg></div>
          <div class="pay-info"><div class="pay-nm">OVO</div><div class="pay-ds">Transfer ke nomor OVO</div></div>
          <div class="radio"></div>
        </div>

        <div class="pay-sec-lbl">Transfer Bank</div>
        <div class="pay-opt" id="po-bca" onclick="selPay('bca')">
          <div class="pay-logo" style="background:#003D82"><svg width="42" height="24" viewBox="0 0 42 24"><text x="7" y="16" font-size="10" font-weight="700" fill="white" font-family="sans-serif">BCA</text></svg></div>
          <div class="pay-info"><div class="pay-nm">Transfer BCA</div><div class="pay-ds">Konfirmasi manual ke admin</div></div>
          <div class="radio"></div>
        </div>
        <div class="pay-opt" id="po-bsi" onclick="selPay('bsi')">
          <div class="pay-logo" style="background:#1A5C38"><svg width="42" height="24" viewBox="0 0 42 24"><text x="8" y="16" font-size="10" font-weight="700" fill="white" font-family="sans-serif">BSI</text></svg></div>
          <div class="pay-info"><div class="pay-nm">Transfer BSI</div><div class="pay-ds">Bank Syariah Indonesia</div></div>
          <div class="radio"></div>
        </div>
        <div class="pay-opt" id="po-mandiri" onclick="selPay('mandiri')" style="border-bottom:none">
          <div class="pay-logo" style="background:#003087"><svg width="42" height="24" viewBox="0 0 42 24"><text x="3" y="15" font-size="7.5" font-weight="700" fill="#F5A623" font-family="sans-serif">MANDIRI</text></svg></div>
          <div class="pay-info"><div class="pay-nm">Transfer Mandiri</div><div class="pay-ds">Konfirmasi manual ke admin</div></div>
          <div class="radio"></div>
        </div>

        <div class="pay-detail show" id="dp-qris">
          <div class="qris-center">
            <div style="font-size:12px;color:var(--text-muted);margin-bottom:4px">Scan QR untuk membayar</div>
            <div style="font-size:17px;font-weight:700;color:var(--grn);margin-bottom:12px" id="qrisAmt">Rp 1.399.000</div>
            <div class="qris-frame">
              <svg width="136" height="136" viewBox="0 0 140 140" xmlns="http://www.w3.org/2000/svg">
                <rect width="140" height="140" fill="white"/>
                <rect x="10" y="10" width="36" height="36" rx="3" fill="#111"/><rect x="14" y="14" width="28" height="28" rx="2" fill="white"/><rect x="18" y="18" width="20" height="20" rx="1" fill="#111"/>
                <rect x="94" y="10" width="36" height="36" rx="3" fill="#111"/><rect x="98" y="14" width="28" height="28" rx="2" fill="white"/><rect x="102" y="18" width="20" height="20" rx="1" fill="#111"/>
                <rect x="10" y="94" width="36" height="36" rx="3" fill="#111"/><rect x="14" y="98" width="28" height="28" rx="2" fill="white"/><rect x="18" y="102" width="20" height="20" rx="1" fill="#111"/>
                <rect x="52" y="10" width="5" height="5" fill="#111"/><rect x="62" y="10" width="5" height="5" fill="#111"/><rect x="75" y="10" width="5" height="5" fill="#111"/>
                <rect x="57" y="18" width="5" height="5" fill="#111"/><rect x="75" y="18" width="5" height="5" fill="#111"/>
                <rect x="52" y="26" width="5" height="5" fill="#111"/><rect x="67" y="26" width="5" height="5" fill="#111"/>
                <rect x="52" y="52" width="5" height="5" fill="#111"/><rect x="67" y="52" width="5" height="5" fill="#111"/><rect x="85" y="52" width="5" height="5" fill="#111"/>
                <rect x="10" y="62" width="5" height="5" fill="#111"/><rect x="57" y="62" width="5" height="5" fill="#111"/><rect x="105" y="62" width="5" height="5" fill="#111"/>
                <rect x="10" y="72" width="5" height="5" fill="#111"/><rect x="62" y="72" width="5" height="5" fill="#111"/><rect x="100" y="72" width="5" height="5" fill="#111"/>
                <rect x="52" y="100" width="5" height="5" fill="#111"/><rect x="67" y="100" width="5" height="5" fill="#111"/><rect x="100" y="100" width="5" height="5" fill="#111"/>
                <rect x="57" y="110" width="5" height="5" fill="#111"/><rect x="110" y="110" width="5" height="5" fill="#111"/>
                <rect x="52" y="120" width="5" height="5" fill="#111"/><rect x="100" y="120" width="5" height="5" fill="#111"/>
                <rect x="60" y="56" width="20" height="28" rx="2" fill="white"/>
                <text x="70" y="66" text-anchor="middle" font-size="5" font-weight="700" fill="#e21e1e" font-family="sans-serif">QRIS</text>
                <text x="70" y="74" text-anchor="middle" font-size="3.8" fill="#555" font-family="sans-serif">BERKAHIN</text>
              </svg>
            </div>
            <div class="qris-timer">Berlaku <strong id="qTimer">14:59</strong></div>
            <div style="font-size:11px;color:var(--text-muted)">GoPay · OVO · Dana · LinkAja · ShopeePay · m-Banking</div>
          </div>
        </div>

        <div class="pay-detail" id="dp-gopay">
          <div class="ew-center">
            <div class="ew-logo" style="background:#00AED6"><svg width="44" height="22" viewBox="0 0 44 22"><text x="2" y="15" font-size="11" font-weight="700" fill="white" font-family="sans-serif">GoPay</text></svg></div>
            <div class="ew-phone">0895-1234-5678</div>
            <div class="ew-holder">a.n. Berkahin</div>
            <div style="font-size:11px;color:var(--text-muted)">Total pembayaran</div>
            <div style="font-size:18px;font-weight:700;color:var(--grn);margin-top:4px" id="gopayAmt">Rp 1.399.000</div>
            <div style="font-size:11px;color:var(--text-muted);margin-top:10px;line-height:1.7">Buka GoPay → Transfer → Masukkan nomor → Nominal</div>
          </div>
        </div>

        <div class="pay-detail" id="dp-ovo">
          <div class="ew-center">
            <div class="ew-logo" style="background:#4C3494"><svg width="40" height="22" viewBox="0 0 40 22"><text x="4" y="15" font-size="13" font-weight="700" fill="white" font-family="sans-serif">OVO</text></svg></div>
            <div class="ew-phone">0895-1234-5678</div>
            <div class="ew-holder">a.n. Berkahin</div>
            <div style="font-size:11px;color:var(--text-muted)">Total pembayaran</div>
            <div style="font-size:18px;font-weight:700;color:var(--grn);margin-top:4px" id="ovoAmt">Rp 1.399.000</div>
            <div style="font-size:11px;color:var(--text-muted);margin-top:10px;line-height:1.7">Buka OVO → Transfer → Masukkan nomor → Nominal</div>
          </div>
        </div>

        <div class="pay-detail" id="dp-bca">
          <div style="font-size:14px;font-weight:600;display:flex;align-items:center;gap:8px;margin-bottom:12px">
            <span style="padding:3px 9px;border-radius:4px;font-size:10px;font-weight:700;color:white;background:#003D82">BCA</span>Bank Central Asia
          </div>
          <div class="bank-norek"><div class="lbl">Nomor Rekening</div><div class="val"><span>1234 5678 90</span><button class="copy-btn" onclick="cp('1234567890')">Salin</button></div></div>
          <div class="bank-norek"><div class="lbl">Atas Nama</div><div class="val" style="font-size:14px;font-weight:500">Yayasan Berkahin</div></div>
          <div class="bank-norek"><div class="lbl">Jumlah Transfer</div><div class="val"><span id="bcaAmt" style="font-size:14px;color:var(--grn)">Rp 1.399.000</span><button class="copy-btn" onclick="cpAmt()">Salin</button></div></div>
          <div class="bank-note"><strong>Penting:</strong> Transfer sesuai nominal agar mudah diverifikasi. Konfirmasi via WhatsApp setelah transfer.</div>
        </div>

        <div class="pay-detail" id="dp-bsi">
          <div style="font-size:14px;font-weight:600;display:flex;align-items:center;gap:8px;margin-bottom:12px">
            <span style="padding:3px 9px;border-radius:4px;font-size:10px;font-weight:700;color:white;background:#1A5C38">BSI</span>Bank Syariah Indonesia
          </div>
          <div class="bank-norek"><div class="lbl">Nomor Rekening</div><div class="val"><span>7123 4567 89</span><button class="copy-btn" onclick="cp('7123456789')">Salin</button></div></div>
          <div class="bank-norek"><div class="lbl">Atas Nama</div><div class="val" style="font-size:14px;font-weight:500">Yayasan Berkahin</div></div>
          <div class="bank-norek"><div class="lbl">Jumlah Transfer</div><div class="val"><span id="bsiAmt" style="font-size:14px;color:var(--grn)">Rp 1.399.000</span><button class="copy-btn" onclick="cpAmt()">Salin</button></div></div>
          <div class="bank-note"><strong>Penting:</strong> Transfer sesuai nominal. Konfirmasi via WhatsApp setelah berhasil.</div>
        </div>

        <div class="pay-detail" id="dp-mandiri">
          <div style="font-size:14px;font-weight:600;display:flex;align-items:center;gap:8px;margin-bottom:12px">
            <span style="padding:3px 9px;border-radius:4px;font-size:10px;font-weight:700;color:#F5A623;background:#003087">MDR</span>Bank Mandiri
          </div>
          <div class="bank-norek"><div class="lbl">Nomor Rekening</div><div class="val"><span>1400 0123 4567</span><button class="copy-btn" onclick="cp('14000123456')">Salin</button></div></div>
          <div class="bank-norek"><div class="lbl">Atas Nama</div><div class="val" style="font-size:14px;font-weight:500">Yayasan Berkahin</div></div>
          <div class="bank-norek"><div class="lbl">Jumlah Transfer</div><div class="val"><span id="mandiriAmt" style="font-size:14px;color:var(--grn)">Rp 1.399.000</span><button class="copy-btn" onclick="cpAmt()">Salin</button></div></div>
          <div class="bank-note"><strong>Penting:</strong> Transfer sesuai nominal. Konfirmasi via WhatsApp setelah berhasil.</div>
        </div>
      </div>

      <div class="form-cta">
        <button class="btn-confirm" onclick="goStep3()">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8l4 4 6-6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Saya Sudah Bayar — Konfirmasi
        </button>
        <button class="btn-back-sm" onclick="goStep1()">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M9 2L4 7l5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Kembali ke Data Donasi
        </button>
      </div>

      <a class="wa-help" href="https://wa.me/6281112345678?text=Halo+admin+Berkahin%2C+saya+butuh+bantuan+donasi+qurban!" target="_blank">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="currentColor"><path d="M7 .5C3.41.5.5 3.41.5 7c0 1.13.3 2.2.83 3.13L.5 13.5l3.44-.88A6.5 6.5 0 1 0 7 .5zm3.39 9.17c-.14.38-.8.73-1.1.77-.28.04-.64.05-.98-.07-.22-.08-.5-.18-.85-.34-1.48-.64-2.44-2.14-2.52-2.24-.07-.1-.6-.8-.6-1.53s.38-1.09.52-1.24a.54.54 0 0 1 .4-.18c.1 0 .2 0 .28.01.09.01.22-.03.33.26.14.33.47 1.14.51 1.22.04.08.07.17.01.28-.06.11-.09.17-.16.27-.08.1-.16.21-.23.29-.08.08-.15.16-.06.32.09.15.39.63.84 1.02.57.51 1.07.67 1.22.74.15.07.24.06.32-.04.09-.11.4-.47.51-.62.11-.15.22-.13.37-.08.15.06.96.45 1.12.53.16.08.27.12.31.19.05.07.05.45-.09.84z"/></svg>
        Perlu bantuan? Chat admin WhatsApp
      </a>
    </div>

    <!-- Panel 3 -->
    <div class="fpanel" id="fpanel3">
      <div class="fcard">
        <div class="sukses-wrap">
          <div class="sukses-sparkle">✨</div>
          <div class="sukses-icon">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M6 16l8 8 12-12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="sukses-title">Jazakallah Khairan! 🎉</div>
          <p class="sukses-sub">Pesanan qurban Anda telah diterima. Admin akan segera menghubungi Anda untuk konfirmasi pembayaran.</p>

          <div class="sukses-detail">
            <div class="sukses-detail-title">Detail Donasi</div>
            <div class="sukses-row"><span class="l">Kode Transaksi</span><span class="v sukses-kode" id="s3-kode">—</span></div>
            <div class="sukses-row"><span class="l">Donatur</span><span class="v" id="s3-nama">—</span></div>
            <div class="sukses-row"><span class="l">Hewan Qurban</span><span class="v" id="s3-hewan">—</span></div>
            <div class="sukses-row"><span class="l">Jumlah</span><span class="v" id="s3-jumlah">—</span></div>
            <div class="sukses-row"><span class="l">Total Bayar</span><span class="v" id="s3-total" style="color:var(--grn)">—</span></div>
            <div class="sukses-row"><span class="l">Metode</span><span class="v" id="s3-metode">—</span></div>
          </div>

          <div class="sukses-notif">
            <div class="sukses-notif-icon">📱</div>
            <div class="sukses-notif-text">
              <strong>Konfirmasi via WhatsApp</strong>
              Kirim bukti transfer ke admin Berkahin agar donasi segera diproses. Sertakan kode transaksi Anda.
            </div>
          </div>

          <div class="sukses-btns">
            <a id="waConfirmBtn" href="#" target="_blank" class="btn-sk-wa">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="white"><path d="M8 .5C3.86.5.5 3.86.5 8c0 1.3.34 2.52.95 3.58L.5 15.5l3.99-1.05A7.5 7.5 0 1 0 8 .5zm3.9 10.6c-.16.44-.92.84-1.27.89-.32.05-.74.06-1.13-.08-.26-.09-.58-.21-.98-.39-1.71-.74-2.82-2.47-2.91-2.58-.08-.12-.7-.92-.7-1.76s.44-1.26.6-1.43a.63.63 0 0 1 .46-.21c.12 0 .23 0 .32.01.1.01.25-.04.39.3.16.38.54 1.32.59 1.41.05.1.08.2.01.32-.07.13-.1.2-.18.31-.1.11-.19.24-.27.33-.09.1-.17.18-.07.37.1.17.45.73.97 1.18.66.59 1.23.77 1.41.85.17.08.27.07.37-.04.11-.13.46-.54.59-.72.12-.17.25-.15.43-.09.17.07 1.11.52 1.3.62.18.09.31.14.36.22.05.08.05.52-.11.97z"/></svg>
              Konfirmasi via WhatsApp
            </a>
            <a href="#" onclick="kembaliLanding();return false" class="btn-sk-primary">Kembali ke Beranda</a>
            <a href="#" onclick="kembaliLanding();return false" class="btn-sk-ghost">Lihat Campaign Lain</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>

<div class="copy-toast" id="copyToast">✓ Link berhasil disalin!</div>



<script>
const PRICES = [1399000, 2500000, 3500000, 24500000];
const NAMES  = ['Kambing Afrika', 'Domba Garut', 'Sapi 1/7 Bagian', 'Sapi Utuh'];
let hw = 0, qty = 1, pay = 'qris', anon = false;

function fmt(n) { return 'Rp ' + n.toLocaleString('id-ID'); }
function total() { return PRICES[hw] * qty; }

window.addEventListener('load', () => {
  setTimeout(() => {
    const pct = (187500000 / 300000000 * 100).toFixed(1);
    document.getElementById('progFill').style.width = pct + '%';
    document.getElementById('progPct').textContent  = pct + '%';
  }, 500);
});

function switchTab(name, el) {
  document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('on'));
  document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('on'));
  el.classList.add('on');
  document.getElementById('tab-' + name).classList.add('on');
}

function toggleShare() {
  document.getElementById('sharePopup').classList.toggle('show');
}

function shareWA() {
  const text = encodeURIComponent('Yuk berqurban bersama Berkahin 1446 H! Mulai dari Rp 1.399.000 · Disalurkan ke 38 provinsi 🐑\n\n' + window.location.href);
  window.open('https://wa.me/?text=' + text, '_blank');
}

function shareTwitter() {
  const text = encodeURIComponent('Semua Bisa Berqurban bersama @Berkahin 1446 H! Mulai Rp 1.399.000 · 38 provinsi 🐑 #Qurban1446H');
  window.open('https://twitter.com/intent/tweet?text=' + text + '&url=' + encodeURIComponent(window.location.href), '_blank');
}

function copyLink() {
  const url = window.location.href;
  if (navigator.clipboard) {
    navigator.clipboard.writeText(url).then(() => showToast('✓ Link berhasil disalin!'));
  } else {
    const ta = document.createElement('textarea');
    ta.value = url; document.body.appendChild(ta);
    ta.select(); document.execCommand('copy');
    document.body.removeChild(ta);
    showToast('✓ Link berhasil disalin!');
  }
  document.getElementById('sharePopup').classList.remove('show');
}

function showToast(msg) {
  const t = document.getElementById('copyToast');
  t.textContent = msg; t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2800);
}

document.addEventListener('click', function(e) {
  const sp = document.getElementById('sharePopup');
  const sb = document.getElementById('shareBtn');
  if (sp && sb && !sp.contains(e.target) && !sb.contains(e.target)) {
    sp.classList.remove('show');
  }
});

function bukaDonasi() {
  document.getElementById('landingView').style.display = 'none';
  document.getElementById('formView').style.display = 'block';
  setStepUI(1);
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function kembaliLanding() {
  document.getElementById('formView').style.display = 'none';
  document.getElementById('landingView').style.display = 'block';
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function selHewan(i) {
  hw = i;
  document.querySelectorAll('.hewan-opt').forEach((el, j) => el.classList.toggle('sel', j === i));
  updateAmounts();
}

function chgQty(d) {
  qty = Math.max(1, qty + d);
  document.getElementById('qtyNum').textContent = qty;
  updateAmounts();
}

function updateAmounts() {
  const t = total();
  document.getElementById('totalVal').textContent   = fmt(t);
  document.getElementById('qrisAmt').textContent    = fmt(t);
  document.getElementById('gopayAmt').textContent   = fmt(t);
  document.getElementById('ovoAmt').textContent     = fmt(t);
  document.getElementById('bcaAmt').textContent     = fmt(t);
  document.getElementById('bsiAmt').textContent     = fmt(t);
  document.getElementById('mandiriAmt').textContent = fmt(t);
}

function setSap(el) {
  document.querySelectorAll('#sapChips .chip').forEach(c => c.classList.remove('on'));
  el.classList.add('on');
}

function toggleAnon() {
  anon = !anon;
  document.getElementById('anonTog').classList.toggle('on', anon);
  const ng = document.getElementById('namaGroup');
  ng.style.opacity = anon ? '0.4' : '1';
  document.getElementById('namaInput').disabled = anon;
}

function selPay(p) {
  pay = p;
  document.querySelectorAll('.pay-opt').forEach(o => o.classList.remove('on'));
  document.getElementById('po-' + p).classList.add('on');
  document.querySelectorAll('.pay-detail').forEach(d => d.classList.remove('show'));
  document.getElementById('dp-' + p).classList.add('show');
}

function cp(val) {
  if (navigator.clipboard) navigator.clipboard.writeText(val);
  showToast('✓ Disalin: ' + val);
}
function cpAmt() {
  const t = total();
  if (navigator.clipboard) navigator.clipboard.writeText(t.toString());
  showToast('✓ Nominal disalin: ' + fmt(t));
}

function setStepUI(step) {
  ['1','2','3'].forEach(n => {
    const si  = document.getElementById('fsi' + n);
    const sn  = document.getElementById('fsn' + n);
    const num = parseInt(n);
    si.classList.remove('act', 'done');
    if (num < step)  si.classList.add('done');
    if (num === step) si.classList.add('act');
    if (num < step) sn.textContent = '✓';
    else sn.textContent = n;
  });
  document.querySelectorAll('.fpanel').forEach(p => p.classList.remove('on'));
  document.getElementById('fpanel' + step).classList.add('on');
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function validate() {
  let ok = true;
  if (!anon) {
    const nm = document.getElementById('namaInput');
    const ne = document.getElementById('namaErr');
    if (!nm.value.trim()) { nm.classList.add('err'); ne.classList.add('show'); ok = false; }
    else { nm.classList.remove('err'); ne.classList.remove('show'); }
  }
  const wa = document.getElementById('waInput');
  const we = document.getElementById('waErr');
  if (!wa.value.trim()) { wa.classList.add('err'); we.classList.add('show'); ok = false; }
  else { wa.classList.remove('err'); we.classList.remove('show'); }
  return ok;
}

function goStep2() {
  if (!validate()) return;
  const sap  = document.querySelector('#sapChips .chip.on')?.textContent || 'Kak';
  const nama = anon ? 'Orang Baik' : document.getElementById('namaInput').value.trim();
  document.getElementById('s2-nama').textContent   = sap + ' ' + nama;
  document.getElementById('s2-hewan').textContent  = NAMES[hw];
  document.getElementById('s2-jumlah').textContent = qty + ' ekor';
  document.getElementById('s2-total').textContent  = fmt(total());
  updateAmounts();
  setStepUI(2);
}

function goStep1() { setStepUI(1); }

function goStep3() {
  const sap  = document.querySelector('#sapChips .chip.on')?.textContent || 'Kak';
  const nama = anon ? 'Orang Baik' : document.getElementById('namaInput').value.trim();
  const kode = 'BKH-QRB-' + Math.random().toString(36).substr(2, 8).toUpperCase();
  const payLabel = { qris:'QRIS', gopay:'GoPay', ovo:'OVO', bca:'Transfer BCA', bsi:'Transfer BSI', mandiri:'Transfer Mandiri' }[pay];

  document.getElementById('s3-kode').textContent   = kode;
  document.getElementById('s3-nama').textContent   = sap + ' ' + nama;
  document.getElementById('s3-hewan').textContent  = NAMES[hw];
  document.getElementById('s3-jumlah').textContent = qty + ' ekor';
  document.getElementById('s3-total').textContent  = fmt(total());
  document.getElementById('s3-metode').textContent = payLabel;

  const pesan = `Assalamu'alaikum admin Berkahin 🌿\n\nSaya ingin konfirmasi donasi qurban:\n\n📋 Kode: ${kode}\n👤 Nama: ${sap} ${nama}\n🐑 Hewan: ${NAMES[hw]} x${qty}\n💰 Total: ${fmt(total())}\n💳 Metode: ${payLabel}\n\nTerlampir bukti transfer. Terima kasih 🙏`;
  document.getElementById('waConfirmBtn').href = 'https://wa.me/6281112345678?text=' + encodeURIComponent(pesan);

  setStepUI(3);
}

let sec = 899;
setInterval(() => {
  sec = Math.max(0, sec - 1);
  const el = document.getElementById('qTimer');
  if (el) {
    const m = String(Math.floor(sec / 60)).padStart(2, '0');
    const s = String(sec % 60).padStart(2, '0');
    el.textContent = m + ':' + s;
  }
}, 1000);
</script>
</body>
</html>