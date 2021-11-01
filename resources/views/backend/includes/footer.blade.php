<footer class="c-footer">
    <div>
        2020 &copy; 
            <x-utils.link href="http://www.aventagelabs.com/" target="_blank" text="Aventage Labs" />
    </div>

    <div class="mfs-auto">
        {{$logged_in_user->user_extra->tenant->tenant_name }}
        ({{$logged_in_user->roles[0]->name}})
    </div>
</footer>
