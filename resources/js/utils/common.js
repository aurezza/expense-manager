
import axios from 'axios';
import $ from 'jquery';

export function Request(url , data , method, callback) {
    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
    let list = axios.post(url,data);

    switch(method)
    {
        case "POST" : list =  axios.post(url,data,{timeout: 10000}); break;
        case "GET" : list = axios.get(url,data,{timeout: 10000}); break;
    }

    list.then(res => {

         let error = false
         let data = []
         let message = ""
         let tags = {}

         if(typeof(res.data) != "object")
         {
             data  = []
             error = true
             message = ""
             tags = {}

         }
         else
         {
            data = res.data.data
            message = res.data.message
            tags = res.data.tags
            error = res.data.error


            if(error && message == '')
            {
                message = 'Error!';
            }
         }

         let result = {
            data : {
                data : data,
                message : message,
                error : error,
                tags : tags,
            }
         }
         console.log('result');
         console.log(typeof(callback)== "function");
         if(typeof(callback)== "function")
         {
             callback(result)
         }
    })
    .catch(err => {
         let result = {
            data : {
                data : null,
                message : err,
                error : true,
                tags : 0,
            }
         }

         if(typeof(callback)== "function")
         {
             callback(result)
         }
    });
    
}

export function Validate($tips, $elements , message)
{   
    let val = $elements.val();
    console.log(val);
    if ($.trim(val) == "" || $.trim(val) == "null")
    {
        $tips.show();
        $elements.focus();
        $tips.html(message);
        return true;
    } 

    return false;
}

export function checkEmail($elem, $tips) {
    let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if(email.value.match(regex)) {
        return true;
    } else {
        $tips.html('Invalid email address.');
        throw new('Not an error. Just to abot javascript.')
    }
}

export function Validate2($tips, $elements , message)
{   
    let val = $elements.val();
    console.log(val);
    if ($.trim(val) == "" || $.trim(val) == "null")
    {
        $tips.show();
        $elements.focus();
        $elements.addClass('input-error');
        $tips.html(message);
        throw new('This is not an error. This is just to abot javascript.');
    } else {
        $elements.removeClass('input-error');
    }
}


export function Log(title,message,type)
{
    console.log(title,message)
}
