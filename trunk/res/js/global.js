var recaptcha = {};
var stat_validate = {
    'screen_name': false,
    'email':false
};
var stat_check = {
    'name':false,
    'screen_name': false,
    'email':false,
    'password': false,
    'repassword': false,
    'captcha':false
};
var band_password = ["111111","11111111","112233","121212","123123","123456","1234567","12345678","131313","232323","654321","666666","696969","777777","7777777","8675309","987654","aaaaaa","abc123","abc123","abcdef","abgrtyu","access","access14","action","albert","alexis","amanda","amateur","andrea","andrew","angela","angels","animal","anthony","apollo","apples","arsenal","arthur","asdfgh","asdfgh","ashley","asshole","august","austin","badboy","bailey","banana","barney","baseball","batman","beaver","beavis","bigcock","bigdaddy","bigdick","bigdog","bigtits","birdie","bitches","biteme","blazer","blonde","blondes","blowjob","blowme","bond007","bonnie","booboo","booger","boomer","boston","brandon","brandy","braves","brazil","bronco","broncos","bulldog","buster","butter","butthead","calvin","camaro","cameron","canada","captain","carlos","carter","casper","charles","charlie","cheese","chelsea","chester","chicago","chicken","cocacola","coffee","college","compaq","computer","cookie","cooper","corvette","cowboy","cowboys","crystal","cumming","cumshot","dakota","dallas","daniel","danielle","debbie","dennis","diablo","diamond","doctor","doggie","dolphin","dolphins","donald","dragon","dreams","driver","eagle1","eagles","edward","einstein","erotic","extreme","falcon","fender","ferrari","firebird","fishing","florida","flower","flyers","football","forever","freddy","freedom","fucked","fucker","fucking","fuckme","fuckyou","gandalf","gateway","gators","gemini","george","giants","ginger","golden","golfer","gordon","gregory","guitar","gunner","hammer","hannah","hardcore","harley","heather","helpme","hentai","hockey","hooters","horney","hotdog","hunter","hunting","iceman","iloveyou","internet","iwantu","jackie","jackson","jaguar","jasmine","jasper","jennifer","jeremy","jessica","johnny","johnson","jordan","joseph","joshua","junior","justin","killer","knight","ladies","lakers","lauren","leather","legend","letmein","letmein","little","london","lovers","maddog","madison","maggie","magnum","marine","marlboro","martin","marvin","master","matrix","matthew","maverick","maxwell","melissa","member","mercedes","merlin","michael","michelle","mickey","midnight","miller","mistress","monica","monkey","monkey","monster","morgan","mother","mountain","muffin","murphy","mustang","naked","nascar","nathan","naughty","ncc1701","newyork","nicholas","nicole","nipple","nipples","oliver","orange","packers","panther","panties","parker","password","password","password1","password12","password123","patrick","peaches","peanut","pepper","phantom","phoenix","player","please","pookie","porsche","prince","princess","private","purple","pussies","qazwsx","qwerty","qwertyui","rabbit","rachel","racing","raiders","rainbow","ranger","rangers","rebecca","redskins","redsox","redwings","richard","robert","rocket","rosebud","runner","rush2112","russia","samantha","sammy","samson","sandra","saturn","scooby","scooter","scorpio","scorpion","secret","sexsex","shadow","shannon","shaved","sierra","silver","skippy","slayer","smokey","snoopy","soccer","sophie","spanky","sparky","spider","squirt","srinivas","startrek","starwars","steelers","steven","sticky","stupid","success","suckit","summer","sunshine","superman","surfer","swimming","sydney","taylor","tennis","teresa","tester","testing","theman","thomas","thunder","thx1138","tiffany","tigers","tigger","tomcat","topgun","toyota","travis","trouble","trustno1","tucker","turtle","twitter","united","vagina","victor","victoria","viking","voodoo","voyager","walter","warrior","welcome","whatever","william","willie","wilson","winner","winston","winter","wizard","xavier","xxxxxx","xxxxxxxx","yamaha","yankee","yankees","yellow","zxcvbn","zxcvbnm","zzzzzz"];

$().ready(function(){
    loadCaptCha();
    actionIndex();
//formLoad();
});

function actionIndex(){
    initlazeKey();
        
    /*
     * authekey check
     */
    /*if($('#authenticity_token').val()==''){
        //alert('initlaize faild! please refresh this page!');
        $('#error_info').html('<a href="javascript:window.location.reload();">Refresh</a>, initlaize faild! ');
    }*/
    /*
     * check form
     */
    $('form').submit(function(){
        return formCheck();
    });
    /*
     * reload captcha
     */
    $('#reloadImg').click(function(){
        loadCaptCha();
        return false;
    });
    /*
     * name check and action
     */
    $('.line.name input').keyup(function(){
        setChange('name');
        check('name');
    });
    $('.line.name input').focus(function(){
        if($(this).val()!='')
            check('name');
        else
            setMsg('name', _l('Set your name!'));
    });
    /*
     * screen name check and action
     */
    $('.line.screen_name input').keyup(function(){
        $(this).val($(this).val().replace(/[\W]/g,''));
        setChange('screen_name');
        check('screen_name');
    });
    $('.line.screen_name input').focus(function(){
        if($(this).val()!=''){
            check('screen_name');
        }else{
            setMsg('screen_name', _l('Set your account username!'));
        }
    });
    $('.line.screen_name input').blur(function(){
        validate('screen_name');
    });
    /*
     * password check and action
     */
    $('.line.password input').keyup(function(){
        setChange('password');
        check('password');
    });
    $('.line.password input').focus(function(){
        if($(this).val()!='')
            check('password');
        else
            setMsg('password', _l('Set your password!'));
    });
    $('.line.repassword input').keyup(function(){
        setChange('repassword');
        check('repassword');
    });
    $('.line.repassword input').focus(function(){
        if($(this).val()!='')
            check('repassword');
        else
            setMsg('repassword', _l('Set your password first!'));
    });
    /*
     * email check and action
     */
    $('.line.email input').keyup(function(){
        setChange('email');
        check('email');
    });
    $('.line.email input').focus(function(){
        if($(this).val()!='')
            check('email');
        else
            setMsg('email', _l('Set your email!'));
    });
    $('.line.email input').blur(function(){
        validate('email');
    });
    /*
     * password check and action
     */
    $('.line.captcha input').keyup(function(){
        setChange('captcha');
        check('captcha');
    });
    $('.line.captcha input').focus(function(){
        if(typeof $('#recaptchaImg').attr('src') == 'undefined'){
            loadCaptCha();
        }else{
            if($(this).val()!='')
                check('captcha');
            else
                setMsg('captcha', _l('Type words above!'));
        }
    });
}
function validate(cls){
    if(stat_check[cls] == false || stat_validate[cls]==true){
        return false;
    }
    setLoad(cls);
    if(cls == 'screen_name'){
        var method = 'valid_username';
    }else{
        var method = 'valid_'+cls;
    }
    $.get('api.php',{
        'm':method,
        's':getVal(cls)
    }, function(message){
        var data= str2json(message);
        if(data.valid){
            setClass(cls, 'ok');
            stat_validate[cls] = true;
        }else{
            setClass(cls, 'er');
        }
        var msg = '';
        if(data.msg){
            msg = _l(data.msg);
        }else{
            msg = _l('Remote error!');
        }
        setMsg(cls, msg);
    });
}
function check(cls){
    var val = getVal(cls);
    switch(cls){
        case 'email':
            var pattern = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            if(!pattern.test(val)){
                setMsg('email', _l('Wrong email format!'));
                setClass('email', 'er');
            }else if(stat_validate['email'] == false){
                setClass('email', '');
                setMsg('email', _l('Wait validation!'));
                stat_check['email'] = true;
            }
            break;
        case 'password':
            if(val.length<6){
                setMsg('password', _l('Too short!'));
                setClass('password', 'er');
            }else{
                var password_band = true;
                for(i in band_password){
                    if(band_password[i] == val){
                        password_band = false;
                    }
                }
                if(password_band == false){
                    setMsg('password', _l('Too obvious!'));
                    setClass('password', 'er');
                }else{
                    setMsg('password', _l('OK!'));
                    setClass('password', 'ok');
                };
            }
            break;
        case 'repassword':
            if($('#password').val()){
                if(val != $('#password').val()){
                    setMsg('repassword', _l('Same as password?'));
                    setClass('repassword', 'er');
                }else{
                    setMsg('repassword', _l('OK!'));
                    setClass('repassword', 'ok');
                }
            }else{
                setMsg('repassword', _l('Set password first?'));
                setClass('repassword', 'er');
            }
            break;
        case 'screen_name':
            if(val.length<2){
                setMsg('screen_name', _l('Too short!'));
                setClass('screen_name', 'er');
            }else if(val.length>16){
                setMsg('screen_name', _l('Too Long!'));
                setClass('screen_name', 'er');
            }else if(stat_validate['screen_name'] == false){
                setClass('screen_name', '');
                setMsg('screen_name', _l('Wait validation!'));
                stat_check['screen_name'] = true;
            }
            break;
        case 'name':
            if(val!=''){
                setMsg('name', _l('OK!'));
                setClass('name', 'ok');
            }else{
                setMsg('captcha', _l('Type name must!'));
                setClass('captcha', 'er');
            }
            break;
        case 'captcha':
            if(val!=''){
                setMsg('captcha', '');
                setClass('captcha', 'ok');
            }else{
                setMsg('captcha', _l('Type words must!'));
                setClass('captcha', 'er');
            }
            break;
    }
}
function setChange(cls){
    stat_check[cls] = false;
    if(typeof stat_validate[cls]!='undefined'){
        stat_validate[cls] = false;
    }
}
function setMsg(cls, msg){
    $('.line.'+cls+' i').html(msg);
}
function setClass(cls, str){
    $('.line.'+cls+' i').attr('class', '').addClass(str);
    if(str=='ok'){
        stat_check[cls] = true;
    }else{
        stat_check[cls] = false;
        if(typeof stat_validate[cls]!='undefined'){
            stat_validate[cls] = false;
        }
    }
}
function setLoad(cls, str){
    if(typeof str == 'undefined'){
        var str = _l('Checking...');
    }
    setClass(cls, '');
    setMsg(cls, '<img src="./res/check.gif" /> '+str);
}
function getVal(cls){
    return $('.line.'+cls+' input').val();
}

function str2json(data){
    try{
        eval('var json=' + data + ';');
    }catch(e){
        return false;
    }
    return json;
}

function loadCaptCha(){
    var hashString = '';
    setLoad('captcha', _l('Load captcha...'));
    $.get('api.php',{
        m:'recaptcha',
        r:Math.random()
    }, function(message){
        recaptcha = str2json(message);
        if(recaptcha.data){
            $('#recaptchaImg').attr('src', recaptcha.image);
            $('#recaptcha_challenge_field').val(recaptcha.data);
            setMsg('captcha', _l('Type words above!'));
        }else{
            setClass('captcha', 'er');
            setMsg('captcha', _l('Load captcha error!'));
        }
    });
}
function formCheck(){
    for(i in stat_check){
        if(stat_check[i] == false){
            check(i);
            if(stat_check[i] == false){
                alert(_l(i)+' '+_l('checked error!'));
                $('#'+i).focus();
                return false;
            }
        }
    }
    for(i in stat_validate){
        if(stat_validate[i] == false){
            alert(_l(i)+' '+_l('must be avaliable!'));
            $('#'+i).focus();
            validate(i);
            return false;
        }
    }
    if($('#recaptcha_challenge_field').val()==''){
        alert(_l(i)+' '+_l('twitter captcha load error, please refresh this page!'));
        return false;
    }
}
function formLoad(){
    for(i in stat_check){
        check(i);
    }
}
function initlazeKey(){
    $('input').attr('disabled', 'true');
    $('#error_info').html('<img src="./res/check.gif" /> '+_l('Intilazing...'));
    $('#error_info').css({
        'color':'#333',
        'font-weight':'normal'
    });
    $.get('api.php', {
        m: 'authkey',
        rand: Math.random()
    }, function(message){
        var data = str2json(message);
        if(data.data){
            $('#error_info').css({
                'color':'#090'
            });
            $('#error_info').html(_l('Initialized!'));
            $('#authenticity_token').val(data.data);
            $('input').removeAttr('disabled');
        }else{
            $('#error_info').css({
                'color':'#f00',
                'font-weight':'bold'
            });
            $('#error_info').html('<a id="reinitialize" href="#">'+_l('Refresh')+'</a>, '+_l('initialized faild!'));
            $('#reinitialize').click(function(){
                initlazeKey();
                return false;
            });
        }
    })
}

function _l(key){
    if(typeof _lang[key] != 'undefined'){
        return _lang[key];
    }else{
        return key;
    }
}