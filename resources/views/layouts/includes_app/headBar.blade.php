<!-- START HEADER -->
<header id="header" class="page-topbar">
	<!-- start header nav-->
	<div class="navbar-fixed">
		<nav class="navbar-color">
			<div class="nav-wrapper">
				<ul class="left">
					<li>
						<h1 class="logo-wrapper">
							<a href="{{ route('accueil') }}" class="brand-logo darken-1">
								<img src="{{ asset('assets/images/logo-roto.png') }}" alt="Roto Logo">
								Roto Gestion de Stock
							</a>
							<span class="logo-text">Roto</span>
						</h1>
					</li>
				</ul>
		<!--
		<div class="header-search-wrapper hide-on-med-and-down">
		  <i class="mdi-action-search"></i>
		  <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize"/>
		</div>
	-->

	<ul class="right hide-on-med-and-down">
		<li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button"  data-activates="translation-dropdown"><img src="{{ asset('assets/images/flag-icons/France.png') }}" alt="Français" /></a></li>
		<li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a></li>
		<li><a href="{{ route('logout') }}" class="waves-effect waves-block waves-light" title="Déconnection"><i class="mdi-navigation-close red-text"></i></a></li>
	</ul>
	<!-- translation-button -->
	<ul id="translation-dropdown" class="dropdown-content">
		<li>
			<a href="#!"><img src="{{ asset('assets/images/flag-icons/France.png') }}" alt="Français" />  <span class="language-select">Français</span></a>
		</li>

	</ul>
</div>
</nav>
</div>
<!-- end header nav-->
</header>
  <!-- END HEADER -->