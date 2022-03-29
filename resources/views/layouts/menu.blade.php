
<li class="nav-item {{ Request::is('membresias*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('membresias.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Membresias</span>
    </a>
</li>
<li class="nav-item {{ Request::is('motors*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('motors.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Motors</span>
    </a>
</li>
<li class="nav-item {{ Request::is('motorMembresias*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('motorMembresias.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Motor Membresias</span>
    </a>
</li><li class="nav-item {{ Request::is('chatMessages*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('chatMessages.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Chat Messages</span>
    </a>
</li>
<li class="nav-item {{ Request::is('messages*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('messages.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Messages</span>
    </a>
</li>
<li class="nav-item {{ Request::is('participantMessages*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('participantMessages.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Participant Messages</span>
    </a>
</li>
