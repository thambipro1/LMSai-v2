<script type="text/javascript">
    $(document).ready(function(){
        const tooltipIds = ['#home', '#aboutus', '#gallery', '#login', '#signup', '#contactus'];

        tooltipIds.forEach(function(id) {
            $(id).tooltip('show').tooltip('hide');
        });
    });
</script>
