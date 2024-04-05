<x-input type="hidden" id="tagRoute" name="route_search_select_tag" :value="route('admin.search.select.tag')" />
<x-input type="hidden" id="danhmucRoute" name="route_search_select_danhmuc" :value="route('admin.search.select.danhmuc')" />

<script>
    $(document).ready(function() {
        select2LoadData($('#tagRoute').val(), '.select2-bs5-ajax[name="tag_id[]"]');
        select2LoadData($('#danhmucRoute').val(), '.select2-bs5-ajax[name="categories_id[]"]');
    });
</script>
