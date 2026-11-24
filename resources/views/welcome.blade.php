<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard · Common Grounds</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .serif { font-family: 'Playfair Display', serif; }
        .nav-link.active { background: #f2eee7; color: #614932; }
    </style>
</head>
<body class="min-h-screen bg-[#f8f7f4] text-[#292820]">
<div class="min-h-screen lg:flex">
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 flex w-64 -translate-x-full flex-col border-r border-[#e9e6df] bg-white px-5 py-6 transition-transform lg:static lg:translate-x-0">
        <a href="#overview" class="flex items-center gap-3 px-2">
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-[#624a34] text-xl text-white">☕</span>
            <span><span class="serif block text-lg font-bold">Common Grounds</span><span class="text-xs text-stone-500">CAFÉ · ADMIN</span></span>
        </a>
        <p class="mb-3 mt-10 px-3 text-[10px] font-bold uppercase tracking-[.18em] text-stone-400">Workspace</p>
        <nav class="flex flex-col gap-1" aria-label="Main navigation">
            <a class="nav-link active flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold" href="#overview"><span>▦</span> Overview</a>
            <a class="nav-link flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-stone-600 hover:bg-stone-50" href="#orders"><span>▤</span> Orders <span class="ml-auto rounded-full bg-[#f3eee7] px-2 py-0.5 text-xs">8</span></a>
            <a class="nav-link flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-stone-600 hover:bg-stone-50" href="#menu"><span>◉</span> Menu</a>
            <a class="nav-link flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-stone-600 hover:bg-stone-50" href="#inventory"><span>▧</span> Inventory</a>
            <a class="nav-link flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-stone-600 hover:bg-stone-50" href="#reports"><span>▥</span> Reports</a>
        </nav>
        <div class="mt-auto rounded-xl bg-[#f7f4ef] p-4">
            <p class="text-xs font-semibold text-stone-700">Need a hand?</p><p class="mt-1 text-xs leading-5 text-stone-500">Your café is looking good. Check the daily guide for tips.</p>
            <a href="#help" class="mt-3 inline-block text-xs font-bold text-[#76583b]">Visit help center →</a>
        </div>
        <button class="mt-4 flex items-center gap-3 rounded-lg p-2 text-left hover:bg-stone-50"><span class="grid h-9 w-9 place-items-center rounded-full bg-[#e8d9c6] text-sm font-bold text-[#624a34]">AM</span><span><span class="block text-sm font-semibold">Alex Morgan</span><span class="text-xs text-stone-500">Store manager</span></span><span class="ml-auto text-stone-400">···</span></button>
    </aside>
    <div id="scrim" class="fixed inset-0 z-20 hidden bg-black/30 lg:hidden"></div>
    <main id="overview" class="min-w-0 flex-1 px-5 py-6 sm:px-8 lg:px-10">
        <header class="mb-8 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3"><button id="menuButton" aria-label="Toggle navigation" class="rounded-lg border border-stone-200 bg-white p-2 lg:hidden">☰</button><div><p class="text-xs font-medium text-stone-500">THURSDAY, OCTOBER 24, 2024</p><h1 class="serif mt-1 text-2xl font-bold sm:text-3xl">Good morning, Alex <span>☀️</span></h1></div></div>
            <div class="hidden items-center gap-3 sm:flex"><button aria-label="Notifications" class="relative rounded-xl border border-stone-200 bg-white p-3">♧<i class="absolute right-2 top-2 h-2 w-2 rounded-full bg-rose-500"></i></button><button class="rounded-xl bg-[#624a34] px-4 py-3 text-sm font-semibold text-white hover:bg-[#503a29]">＋ <span class="hidden sm:inline">New order</span></button></div>
        </header>
        <section class="mb-7 flex flex-wrap items-end justify-between gap-3"><div><h2 class="text-lg font-bold">Today at a glance</h2><p class="mt-1 text-sm text-stone-500">Here’s what’s happening at your café today.</p></div><button class="rounded-lg border border-stone-200 bg-white px-3 py-2 text-sm text-stone-600">Today⌄</button></section>
        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Sales statistics">
            <article class="rounded-2xl border border-stone-100 bg-white p-5"><div class="flex justify-between text-sm text-stone-500"><span>Today’s sales</span><span>↗</span></div><p class="mt-4 text-3xl font-bold">$2,840<span class="text-stone-400">.50</span></p><p class="mt-2 text-xs"><span class="font-bold text-emerald-700">↑ 12.8%</span><span class="text-stone-400"> vs. yesterday</span></p></article>
            <article class="rounded-2xl border border-stone-100 bg-white p-5"><div class="flex justify-between text-sm text-stone-500"><span>Total orders</span><span>▤</span></div><p class="mt-4 text-3xl font-bold">124</p><p class="mt-2 text-xs"><span class="font-bold text-emerald-700">↑ 8.2%</span><span class="text-stone-400"> vs. yesterday</span></p></article>
            <article class="rounded-2xl border border-stone-100 bg-white p-5"><div class="flex justify-between text-sm text-stone-500"><span>Average order value</span><span>◉</span></div><p class="mt-4 text-3xl font-bold">$22<span class="text-stone-400">.91</span></p><p class="mt-2 text-xs"><span class="font-bold text-emerald-700">↑ 3.4%</span><span class="text-stone-400"> vs. yesterday</span></p></article>
            <article class="rounded-2xl border border-stone-100 bg-white p-5"><div class="flex justify-between text-sm text-stone-500"><span>Table occupancy</span><span>⌂</span></div><p class="mt-4 text-3xl font-bold">68<span class="text-lg">%</span></p><p class="mt-2 text-xs text-stone-400">17 of 25 tables occupied</p></article>
        </section>
        <section class="mt-6 grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <article id="reports" class="rounded-2xl border border-stone-100 bg-white p-5 sm:p-6"><div class="flex flex-wrap items-center justify-between gap-3"><div><h2 class="font-bold">Sales overview</h2><p class="mt-1 text-xs text-stone-500">Your revenue over the last 7 days</p></div><span class="flex items-center gap-2 text-xs text-stone-500"><i class="h-2 w-2 rounded-full bg-[#96724f]"></i> Revenue</span></div>
                <div class="mt-6"><svg viewBox="0 0 700 210" role="img" aria-label="Sales increased over the week, peaking on Saturday" class="h-48 w-full overflow-visible"><defs><linearGradient id="fill" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#b99a75" stop-opacity=".28"/><stop offset="1" stop-color="#b99a75" stop-opacity="0"/></linearGradient></defs><path d="M30 160H680M30 115H680M30 70H680M30 25H680" stroke="#eeeae4" stroke-dasharray="3 5"/><path d="M30 155 C75 145 85 125 125 134 S210 100 245 112 S320 72 365 94 S440 54 485 69 S565 35 600 55 S650 25 680 34 L680 180 L30 180Z" fill="url(#fill)"/><path d="M30 155 C75 145 85 125 125 134 S210 100 245 112 S320 72 365 94 S440 54 485 69 S565 35 600 55 S650 25 680 34" fill="none" stroke="#96724f" stroke-width="3" stroke-linecap="round"/><g fill="#96724f"><circle cx="30" cy="155" r="4"/><circle cx="125" cy="134" r="4"/><circle cx="245" cy="112" r="4"/><circle cx="365" cy="94" r="4"/><circle cx="485" cy="69" r="4"/><circle cx="600" cy="55" r="4"/><circle cx="680" cy="34" r="4"/></g><g fill="#a8a29e" font-size="11"><text x="28" y="204">Mon</text><text x="123" y="204">Tue</text><text x="243" y="204">Wed</text><text x="363" y="204">Thu</text><text x="483" y="204">Fri</text><text x="598" y="204">Sat</text><text x="672" y="204">Sun</text></g></svg></div></article>
            <article id="inventory" class="rounded-2xl border border-stone-100 bg-white p-5 sm:p-6"><div class="flex items-center justify-between"><div><h2 class="font-bold">Inventory alerts</h2><p class="mt-1 text-xs text-stone-500">Items that need your attention</p></div><span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700">3 alerts</span></div>
                <div class="mt-5 divide-y divide-stone-100"><div class="flex items-center gap-3 py-3"><span class="grid h-9 w-9 place-items-center rounded-lg bg-orange-50">☕</span><span class="flex-1"><b class="block text-sm">Oat milk</b><small class="text-xs text-stone-500">Dairy alternatives</small></span><span class="text-right"><b class="block text-sm text-rose-600">2 cartons</b><small class="text-xs text-stone-400">Low stock</small></span></div><div class="flex items-center gap-3 py-3"><span class="grid h-9 w-9 place-items-center rounded-lg bg-amber-50">🌱</span><span class="flex-1"><b class="block text-sm">House espresso</b><small class="text-xs text-stone-500">Coffee beans</small></span><span class="text-right"><b class="block text-sm text-amber-600">1.2 kg</b><small class="text-xs text-stone-400">Running low</small></span></div><div class="flex items-center gap-3 py-3"><span class="grid h-9 w-9 place-items-center rounded-lg bg-rose-50">🥐</span><span class="flex-1"><b class="block text-sm">Butter croissants</b><small class="text-xs text-stone-500">Bakery</small></span><span class="text-right"><b class="block text-sm text-rose-600">4 left</b><small class="text-xs text-stone-400">Low stock</small></span></div></div><a href="#inventory" class="mt-2 inline-block text-sm font-semibold text-[#76583b]">Manage inventory →</a></article>
        </section>
        <section class="mt-6 grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <article id="orders" class="overflow-hidden rounded-2xl border border-stone-100 bg-white"><div class="flex items-center justify-between p-5 sm:px-6"><div><h2 class="font-bold">Recent orders</h2><p class="mt-1 text-xs text-stone-500">Keep track of what’s coming through</p></div><a href="#orders" class="text-sm font-semibold text-[#76583b]">View all →</a></div><div class="overflow-x-auto"><table class="w-full min-w-[560px] text-left text-sm"><thead class="bg-[#faf9f7] text-[11px] uppercase tracking-wide text-stone-400"><tr><th class="px-6 py-3 font-semibold">Order</th><th class="px-4 py-3 font-semibold">Customer</th><th class="px-4 py-3 font-semibold">Items</th><th class="px-4 py-3 font-semibold">Total</th><th class="px-6 py-3 font-semibold">Status</th></tr></thead><tbody class="divide-y divide-stone-100"><tr><td class="px-6 py-4 font-semibold">#CG-1048</td><td class="px-4 py-4">Emma Wilson</td><td class="px-4 py-4 text-stone-500">3 items</td><td class="px-4 py-4 font-semibold">$18.50</td><td class="px-6 py-4"><span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Completed</span></td></tr><tr><td class="px-6 py-4 font-semibold">#CG-1047</td><td class="px-4 py-4">Noah Chen</td><td class="px-4 py-4 text-stone-500">2 items</td><td class="px-4 py-4 font-semibold">$12.00</td><td class="px-6 py-4"><span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">Preparing</span></td></tr><tr><td class="px-6 py-4 font-semibold">#CG-1046</td><td class="px-4 py-4">Olivia Martin</td><td class="px-4 py-4 text-stone-500">5 items</td><td class="px-4 py-4 font-semibold">$32.75</td><td class="px-6 py-4"><span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Completed</span></td></tr></tbody></table></div></article>
            <article class="rounded-2xl border border-stone-100 bg-white p-5 sm:p-6"><div class="flex items-center justify-between"><div><h2 class="font-bold">Quick actions</h2><p class="mt-1 text-xs text-stone-500">A few things you can do right now</p></div><span class="text-lg">✦</span></div><div class="mt-5 grid grid-cols-2 gap-3"><a href="#orders" class="rounded-xl border border-stone-100 p-4 hover:border-[#cbb79e] hover:bg-[#fcfaf7]"><span class="text-xl">＋</span><b class="mt-3 block text-sm">New order</b><small class="mt-1 block text-xs text-stone-500">Create an order</small></a><a href="#menu" class="rounded-xl border border-stone-100 p-4 hover:border-[#cbb79e] hover:bg-[#fcfaf7]"><span class="text-xl">☷</span><b class="mt-3 block text-sm">Update menu</b><small class="mt-1 block text-xs text-stone-500">Edit items & prices</small></a><a href="#inventory" class="rounded-xl border border-stone-100 p-4 hover:border-[#cbb79e] hover:bg-[#fcfaf7]"><span class="text-xl">▧</span><b class="mt-3 block text-sm">Add stock</b><small class="mt-1 block text-xs text-stone-500">Restock inventory</small></a><a href="#reports" class="rounded-xl border border-stone-100 p-4 hover:border-[#cbb79e] hover:bg-[#fcfaf7]"><span class="text-xl">▥</span><b class="mt-3 block text-sm">View reports</b><small class="mt-1 block text-xs text-stone-500">See performance</small></a></div></article>
        </section>
        <footer class="py-7 text-center text-xs text-stone-400">Made with care at Common Grounds · 2024</footer>
    </main>
</div>
<script>
    const sidebar = document.getElementById('sidebar');
    const scrim = document.getElementById('scrim');
    const toggleMenu = () => {
        sidebar.classList.toggle('-translate-x-full');
        scrim.classList.toggle('hidden');
    };
    document.getElementById('menuButton').addEventListener('click', toggleMenu);
    scrim.addEventListener('click', toggleMenu);
    document.querySelectorAll('.nav-link').forEach((link) => link.addEventListener('click', () => {
        document.querySelectorAll('.nav-link').forEach((item) => item.classList.remove('active'));
        link.classList.add('active');
        if (window.innerWidth < 1024 && !sidebar.classList.contains('-translate-x-full')) toggleMenu();
    }));
</script>
</body>
</html>
