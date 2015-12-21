/**
 * Copyright (c) 2015, Pryadkin Sergey <GiperProger@gmail.com>
 * All rights reserved.

 * ATTENTION: This commercial software is intended for use with Oxwall Free Community Software http://www.oxwall.org/
 * and is licensed under Oxwall Store Commercial License.
 * Full text of this license can be found at http://www.oxwall.org/store/oscl
 */

/**
 * @author Pryadkin Sergey <GiperProger@gmail.com>
 * @package ow_plugins.selectgender.static.js
 * @since 1.0
 */

var SELECTGENDER_QuickSearch = function()
{


    this.init = function(params)
    {
        var form = $("form[name=QuickSearchForm]");
        var sex = $("select[name=sex]", form);
        var userSex = params['userSex'];
        $("[value='"+userSex+"']", sex).attr("selected", "selected");


        if( params['opositeMatchSexSearch']  )
        {
            if (params['userSex'] == 1)
            {
                $("[name = match_sex] [value='1']", form). remove();
            }
            else
            {
                $("[name = match_sex] [value='2']", form). remove();
            }
        }

        if( params['sameMatchSexSearch']  )
        {
            if (params['userSex'] == 2)
            {
                $("[name = match_sex] [value='1']", form). remove();
            }
            else
            {
                $("[name = match_sex] [value='2']", form). remove();
            }
        }





    }

} 