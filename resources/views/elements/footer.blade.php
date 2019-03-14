<footer class="main-footer">
    @if(config('app.show_version') == 1)
    <div class="pull-right hidden-xs">
        <b>Version</b> {{ config('app.version_info') }}
    </div>
    @endif
    <strong>Copyright &copy; {{ config('app.copyright_year')}} <a href="#">{{ config('app.company_name') }}</a>.</strong> All rights
    reserved.
</footer>