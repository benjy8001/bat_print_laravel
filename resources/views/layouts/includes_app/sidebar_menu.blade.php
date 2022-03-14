<!-- START LEFT SIDEBAR NAV-->
<aside id="left-sidebar-nav">
	<ul id="slide-out" class="side-nav fixed leftside-navigation">
		<li class="user-details black darken-2">
			<div class="row">
				<div class="col col s12 m12 l12">
					<ul id="profile-dropdown" class="dropdown-content">
						<li><a href="{{ route('profileUser') }}"><i class="mdi-action-face-unlock"></i> Profil</a></li>
						<li class="divider"></li>
						<li><a href="{{ route('logout') }}""><i class="mdi-hardware-keyboard-tab"></i> Sortie</a></li>
					</ul>
					<a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">{{ Auth::user()->name }} <i class="mdi-navigation-arrow-drop-down right"></i></a>
					<p class="user-roal">{{ Auth::user()->roles()->first()->name }}</p>
				</div>
			</div>
		</li>
		<li class="bold {{ Route::current()->getName() == 'accueil' ? 'active' : '' }}">
			<a href="{{ route('accueil') }}" class="waves-effect waves-black {{ Route::current()->getName() == 'accueil' ? 'active' : '' }}"><i class="mdi-action-dashboard"></i> Tableau de bord</a>
		</li>
		<li class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li class="bold {{ (Route::current()->getName() == 'viewStock' || Route::current()->getName() == 'viewExtractStock') ? 'active' : '' }}">
					<a class="collapsible-header waves-effect waves-black {{ (Route::current()->getName() == 'viewStock' || Route::current()->getName() == 'viewExtractStock') ? 'active' : '' }}"><i class="mdi-communication-import-export"></i> Stock</a>
					<div class="collapsible-body">
						<ul>
							<li class="{{ Route::current()->getName() == 'viewStock' ? 'active' : '' }}">
								<a href="{{ route('viewStock') }}" class="{{ Route::current()->getName() == 'viewStock' ? 'active' : '' }}">Liste</a>
							</li>
							@if(Auth::user()->hasRole('administrateur'))
							<li class="{{ Route::current()->getName() == 'viewExtractStock' ? 'active' : '' }}">
								<a href="{{ route('viewExtractStock') }}" class="{{ Route::current()->getName() == 'viewExtractStock' ? 'active' : '' }}">Extraction</a>
							</li>
							@endif
						</ul>
					</div>
				</ul>
			</li>
			<li class="bold {{ Route::current()->getName() == 'entrees' ? 'active' : '' }}">
				<a href="{{ route('entrees') }}" class="waves-effect waves-black {{ Route::current()->getName() == 'entrees' ? 'active' : '' }}"><i class="mdi-content-add-circle-outline"></i> Entrées</a>
			</li>
			<li class="bold {{ Route::current()->getName() == 'sorties' ? 'active' : '' }}">
				<a href="{{ route('sorties') }}" class="waves-effect waves-black {{ Route::current()->getName() == 'sorties' ? 'active' : '' }}"><i class="mdi-content-remove-circle-outline"></i> Sorties</a>
			</li>
			@if(Auth::user()->hasRole('administrateur'))
			<li class="bold {{ Route::current()->getName() == 'viewUsers' ? 'active' : '' }}">
				<a href="{{ route('viewUsers') }}" class="waves-effect waves-black {{ Route::current()->getName() == 'viewUsers' ? 'active' : '' }}"><i class="mdi-social-people"></i> Utilisateurs</a>
			</li>
			@endif
		</ul>
		<a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only black"><i class="mdi-navigation-menu"></i></a>
	</aside>
<!-- END LEFT SIDEBAR NAV-->