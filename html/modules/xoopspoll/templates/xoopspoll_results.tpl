<div class='center' style='margin: 3px auto;'>
<{include file="db:xoopspoll_results_renderer.html"}>
</div>
<div class='marg5 pad3 center'>
  <{$commentsnav}>
  <{$lang_notice}>
</div>
<div class='marg3 pad3'>
<!-- start comments loop -->
<{if $comment_mode == "flat"}>
  <{include file="db:system_comments_flat.html"}>
<{elseif $comment_mode == "thread"}>
  <{include file="db:system_comments_thread.html"}>
<{elseif $comment_mode == "nest"}>
  <{include file="db:system_comments_nest.html"}>
<{/if}>
<!-- end comments loop -->
</div>