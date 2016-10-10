/**
 * 地区联动处理
 * 用法:
 *      <select id="club-cid" class="form-control district" data-conf="{"type":"cid","sub":"#club-did","clear":["#club-did"],"default":["市"]}" name="Club[cid]">
 * Created by zwj on 2016/6/15.
 */
var district={
    changeSub: function (e) {
        var conf = $(this).data('conf');
        if (conf.clear.length == 0) {
            return;
        }
        $.each(conf.clear, function (i,selector){
            district.changeSelect(selector, $(selector).data('conf').default);
        });
        if($(this).val() == 0){
            return ;
        }
        if(!conf.myHandle) {
            $.ajax({
                url: '/admin/json/district/get-sub-drop-down',
                type: 'get',
                data: {'pid': $(this).val()},
                dataType: 'json',
                success: function (resp) {
                    if (resp.code == 1 && resp.data.count > 0) {
                        var data = $.extend({}, $(conf.sub).data('conf').default, resp.data.list_data);
                        district.changeSelect(conf.sub, data);
                    }
                }
            });
        }else{
            window[conf.myHandle](this,conf);
        }
    },
    changeSelect: function (selector, data) {
        var html = '';
        for(var i in data){
            html += '<option value="'+i+'">'+data[i]+'</option>';
        }
        $(selector).html(html);
    }
};
(function ($) {
    $.fn.createDistrict = function () {
        $(this).change(district.changeSub);
    };
})(jQuery);