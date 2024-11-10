@foreach ($variables as $variable)
    <a class="dropdown-item" href="#" onclick="setTemplateVariable('{{ $variable->name }}')">
        <span class="text-danger">{{ $variable->name }} :
        </span>
        <span>{{ $variable->details }}</span>
    </a>
@endforeach
