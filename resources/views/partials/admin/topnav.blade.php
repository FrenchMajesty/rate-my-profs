<nav class="navbar navbar-transparent navbar-absolute">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse">
        <span class="sr-only">{{__('toggle navigation')}}</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Awesome website</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="material-icons">person</i>
            <p class="hidden-lg hidden-md">{{__('profile')}}</p>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">Update your profile info</a></li>
            <li><a href="#">Log out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>