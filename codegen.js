var chanceCode = new Chance();

function codeGen(){
    var code = '';
    var sum  = 0;

    while (sum <= 100)
    {
        var temp = chanceCode.integer({min:1,max:9});

        if ((sum + temp) <= 100){
            code += temp;
        } else{
            code += (100-sum);
        }
        sum += temp;
    }

    return code;
}

function checkCode(code){
    if (code.split('').map(x => parseInt(x)).reduce((a,b) => a+b) == 100)
        return true;
    else
        return false;
}
