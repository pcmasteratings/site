<?php // Footer (and javascript which should load at the end)
?>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-65164050-1', 'auto');
    ga('send', 'pageview');
</script>