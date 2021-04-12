<header class="{{ isset($nav_light) ? 'nav-light' : '' }} {{ isset($nav_dark) ? 'nav-dark' : '' }} border-b">
	<div class="container flex-none md:flex items-center justify-center lg:justify-between flex-wrap">
		<div class="site-logo my-6 md:my-2 lg:my-0 md:px-0 px-6">
			<a href="#">
				<img src="{{ asset('images/logo/logo-alc.png') }}" class="my-0 mx-auto" />
			</a>
		</div>
		<div class="site-menu w-full md:w-auto">
			<button class="uppercase text-sm inline-flex items-center justify-between bg-primary text-white font-bold py-2 px-4 mx-0 md:mx-2.5 border border-primary rounded-lg w-full md:w-auto mb-5 md:mb-0">
				Je fais un don
				<img src="{{ asset('images/icons/ic-arrow.svg') }}" class="ml-2" alt="arrow-icon" />
			</button>
			<button class="uppercase text-sm bg-white hover:bg-gray-100 text-gray-400 md:text-dark-gray font-bold py-2 px-4 mx-0 md:mx-2.5 border-0 border-gray-300 rounded-lg w-full md:w-auto md:border">
				Parcourir les collectes
			</button>
		</div>
	</div>
</header>
