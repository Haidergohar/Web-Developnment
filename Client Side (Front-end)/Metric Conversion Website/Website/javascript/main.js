// main javascript sheet

var area = document.getElementById("areas");
var vol = document.getElementById("vol");
var mass = document.getElementById("mass");
var temp = document.getElementById("temp");
var currency = document.getElementById("currency");
var lenght = document.getElementById("lenght");
var dropdown_1 = document.getElementById("slct_1");
var dropdown_2 = document.getElementById("slct_2");
var input_1 = document.getElementById("input_1");
var input_2 = document.getElementById("input_2");


function new_options()
{

    if (area.checked == true) {
        dropdown_1.innerHTML = "";
        dropdown_2.innerHTML = "";
        var new_opt = "<option value='si'>Square Inches</option><option value='smm'>Square Milimeters</option><option value='sf'>Square Feet</option><option value='sm'>Square Meter</option><option value='sy'>Square Yards</option><option value='acre'>Acres</option><option value='hectares'>Hectares</option><option value='smile'>Square Miles</option><option value='skm'>Square Kilometers</option>";
        dropdown_1.innerHTML = new_opt;
        dropdown_2.innerHTML = new_opt;
    }
    
    else if (vol.checked == true) {
        dropdown_1.innerHTML = "";
        dropdown_2.innerHTML = "";
        var new_opt = "<option value='fo'>Fluid Ounces</option><option value='ml'>Mililiters</option><option value='gln'>Gallons</option><option value='ltr'>Liters</option><option value='cf'>Cubic Feet</option><option value='cy'>Cubic Yards</option><option value='cm'>Cubic Meters</option>";
        dropdown_1.innerHTML = new_opt;
        dropdown_2.innerHTML = new_opt;
    }
    
    else if (mass.checked == true) {
        dropdown_1.innerHTML = "";
        dropdown_2.innerHTML = "";
        var new_opt = "<option value='on'>Ounces</option><option value='gr'>Grams</option><option value='pnd'>Pounds</option><option value='kg'>Kilograms</option><option value='st'>Short Tons (2000 lb)</option><option value='mg'>Mega Grams</option>";
        dropdown_1.innerHTML = new_opt;
        dropdown_2.innerHTML = new_opt;
    }

    else if (temp.checked) {
        dropdown_1.innerHTML = "";
        dropdown_2.innerHTML = "";
        var new_opt = "<option value='cls'>Celsius</option><option value='fhr'>Fahrenheit</option>";
        dropdown_1.innerHTML = new_opt;
        dropdown_2.innerHTML = new_opt;
    }

    else if (currency.checked) {
        dropdown_1.innerHTML = "";
        dropdown_2.innerHTML = "";
        var new_opt = "<option value='pk'>Pakistan</option><option value='usd'>U.S Dollar</option><option value='ch'>Chinese Yuan</option><option value='sr'>Saudi Riyal</option>";
        dropdown_1.innerHTML = new_opt;
        dropdown_2.innerHTML = new_opt;
    }

    else if (lenght.checked) {
        dropdown_1.innerHTML = "";
        dropdown_2.innerHTML = "";
        var new_opt = "<option value='inch'>Inches</option><option value='mm'>Milimeters</option><option value='ft'>Feet</option><option value='m'>Meters</option><option value='yr'>Yards</option><option value='ml'>Miles</option><option value='km'>Kilometers</option>";
        dropdown_1.innerHTML = new_opt;
        dropdown_2.innerHTML = new_opt;
    }

}

function converter(){
    if (area.checked) {
        areaconversions();
    }

    else if (vol.checked) {
        volumeconversions();
    }
    
    else if (mass.checked) {
        massconversions();
    }

    else if (temp.checked) {
        tempconversions();
    }

    else if (currency.checked) {
        currencyconversions();
    }

    else if (lenght.checked) {
        lenghtconversions();
    }
}

function areaconversions(){
    if (dropdown_1.value == "si") {
        squareinchconversions();
    }
    
    else if(dropdown_1.value == "smm"){
        squaremmconversions();
    }

    else if(dropdown_1.value == "sf"){
        squarefeetconversions();
    }

    else if(dropdown_1.value == "sm"){
        squaremeterconversions();
    }

    else if(dropdown_1.value == "sy"){
        squareyardconversions();
    }

    else if(dropdown_1.value == "acre"){
        squareacresconversions();
    }

    else if(dropdown_1.value == "hectares"){
        squarehectaresconversions();
    }

    else if(dropdown_1.value == "smile"){
        squaremilesconversions();
    }

    else if(dropdown_1.value == "skm"){
        squarekmconversions();
    }

}

function volumeconversions(){
    if (dropdown_1.value == "fo") {
        fluidounceconversions();
    }

    else if (dropdown_1.value == "ml") {
        mililitersconversions();
    }

    else if (dropdown_1.value == "gln") {
        gallonsconversions();
    }

    else if (dropdown_1.value == "ltr") {
        litersconversions();
    }

    else if (dropdown_1.value == "cf") {
        cubicfeetsconversions();
    }

    else if (dropdown_1.value == "cy") {
        cubicyardsconversions();
    }

    else if (dropdown_1.value == "cm") {
        cubicmeterconversions();
    }
}

function massconversions(){

    if (dropdown_1.value == "on") {
        ouunceconversions();
    }

    else if (dropdown_1.value == "gr") {
        gramsconversions();
    }

    else if (dropdown_1.value == "pnd") {
        poundconversions();
    }

    else if (dropdown_1.value == "kg") {
        kgconversions();
    }

    else if (dropdown_1.value == "st") {
        shorttonconversions();
    }

    else if (dropdown_1.value == "mg") {
        megagramconversions();
    }
}

function tempconversions(){

    if (dropdown_1.value == "cls") {
        celsiusconversions();
    }

    else if (dropdown_1.value == "fhr") {
        fahrenheitconversions();
    }
}

function lenghtconversions(){
    
    if (dropdown_1.value == "inch") {
        inchconversions();
    }

    else if (dropdown_1.value == "mm") {
        milimeterconversions();
    }

    else if (dropdown_1.value == "ft") {
        feetconversions();
    }

    else if (dropdown_1.value == "m") {
        meterconversions();
    }

    else if (dropdown_1.value == "yr") {
        yardsconversions();
    }

    else if (dropdown_1.value == "ml") {
        milesconversions();
    }

    else if (dropdown_1.value == "km") {
        kilometersconversions();
    }
}

function currencyconversions(){
    
    if (dropdown_1.value == "pk") {
        pkconversions();
    }

    else if (dropdown_1.value == "usd") {
        usdconversions();
    }

    else if (dropdown_1.value == "ch") {
        chinayuanconversions();
    }

    else if (dropdown_1.value == "sr") {
        riyalconversions();
    }
}


// start area conversions

function squareinchconversions(){
    
    if (dropdown_2.value == "si") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "smm") {
        input_2.value = input_1.value * 645.16;
    }

    else if (dropdown_2.value == "sf") {
        input_2.value = input_1.value / 144;
    }

    else if (dropdown_2.value == "sm") {
        input_2.value = input_1.value / 1550.003;
    }

    else if (dropdown_2.value == "sy") {
        input_2.value = input_1.value / 1296;
    }

    else if (dropdown_2.value == "acre") {
        input_2.value = input_1.value / 1.5942e-7;
    }

    else if (dropdown_2.value == "hectares") {
        input_2.value = input_1.value / 1.55e+7;
    }

    else if (dropdown_2.value == "smile") {
        input_2.value = input_1.value / 4.014e+9;
    }

    else if (dropdown_2.value == "skm") {
        input_2.value = input_1.value / 1.55e+9;
    }
}


function squaremmconversions(){
 
    if (dropdown_2.value == "si") {
        input_2.value = input_1.value / 645.16;
    }

    else if (dropdown_2.value == "smm") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "sf") {
        input_2.value = input_1.value / 92903.04;
    }

    else if (dropdown_2.value == "sm") {
        input_2.value = input_1.value / 1e-6;
    }

    else if (dropdown_2.value == "sy") {
        input_2.value = input_1.value / 1.196e-6;
    }

    else if (dropdown_2.value == "acre") {
        input_2.value = input_1.value / 2.4711e-10;
    }

    else if (dropdown_2.value == "hectares") {
        input_2.value = input_1.value / 1e+10;
    }

    else if (dropdown_2.value == "smile") {
        input_2.value = input_1.value / 2.59e+12;
    }

    else if (dropdown_2.value == "skm") {
        input_2.value = input_1.value / 1e+12;
    }
}


function squarefeetconversions(){

    if (dropdown_2.value == "si") {
        input_2.value = input_1.value * 144;
    }

    else if (dropdown_2.value == "smm") {
        input_2.value = input_1.value * 92903.04;
    }

    else if (dropdown_2.value == "sf") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "sm") {
        input_2.value = input_1.value / 10.764;
    }

    else if (dropdown_2.value == "sy") {
        input_2.value = input_1.value / 9;
    }

    else if (dropdown_2.value == "acre") {
        input_2.value = input_1.value / 43560;
    }

    else if (dropdown_2.value == "hectares") {
        input_2.value = input_1.value / 107639.104;
    }

    else if (dropdown_2.value == "smile") {
        input_2.value = input_1.value / 2.788e+7;
    }

    else if (dropdown_2.value == "skm") {
        input_2.value = input_1.value / 1.076e+7;
    }
}


function squaremeterconversions(){
    
    if (dropdown_2.value == "si") {
        input_2.value = input_1.value * 1550.003;
    }

    else if (dropdown_2.value == "smm") {
        input_2.value = input_1.value * 1e+6;
    }

    else if (dropdown_2.value == "sf") {
        input_2.value = input_1.value * 10.764;
    }

    else if (dropdown_2.value == "sm") {
        input_2.value = input_1.value ;
    }

    else if (dropdown_2.value == "sy") {
        input_2.value = input_1.value * 1.196;
    }

    else if (dropdown_2.value == "acre") {
        input_2.value = input_1.value / 4046.856;
    }

    else if (dropdown_2.value == "hectares") {
        input_2.value = input_1.value / 10000;
    }

    else if (dropdown_2.value == "smile") {
        input_2.value = input_1.value / 2.59e+6;
    }

    else if (dropdown_2.value == "skm") {
        input_2.value = input_1.value / 1e+6;
        
    }
}


function squareyardconversions(){
    
    if (dropdown_2.value == "si") {
        input_2.value = input_1.value * 1296;
        
    }

    else if (dropdown_2.value == "smm") {
        input_2.value = input_1.value * 836127.36;
    }

    else if (dropdown_2.value == "sf") {
        input_2.value = input_1.value * 9;
    }

    else if (dropdown_2.value == "sm") {
        input_2.value = input_1.value / 1.196;
    }

    else if (dropdown_2.value == "sy") {
        input_2.value = input_1.value ;
    }

    else if (dropdown_2.value == "acre") {
        input_2.value = input_1.value / 4840;
    }

    else if (dropdown_2.value == "hectares") {
        input_2.value = input_1.value / 11959.9;
    }

    else if (dropdown_2.value == "smile") {
        input_2.value = input_1.value / 3.098e+6;
    }

    else if (dropdown_2.value == "skm") {
        input_2.value = input_1.value / 1.196e+6;
        
    }
}


function squareacresconversions(){
    
    if (dropdown_2.value == "si") {
        input_2.value = input_1.value * 6.273e+6;
        
    }

    else if (dropdown_2.value == "smm") {
        input_2.value = input_1.value * 4.047e+9;
    }

    else if (dropdown_2.value == "sf") {
        input_2.value = input_1.value * 43560;
    }

    else if (dropdown_2.value == "sm") {
        input_2.value = input_1.value * 4046.856;
    }

    else if (dropdown_2.value == "sy") {
        input_2.value = input_1.value * 4840;
    }

    else if (dropdown_2.value == "acre") {
        input_2.value = input_1.value ;
    }

    else if (dropdown_2.value == "hectares") {
        input_2.value = input_1.value / 2.471;
    }

    else if (dropdown_2.value == "smile") {
        input_2.value = input_1.value / 640;
    }

    else if (dropdown_2.value == "skm") {
        input_2.value = input_1.value / 247.105;
        
    }
}


function squarehectaresconversions(){
    
    if (dropdown_2.value == "si") {
        input_2.value = input_1.value / 1.55e+7;
        
    }

    else if (dropdown_2.value == "smm") {
        input_2.value = input_1.value * 1e+10;
    }

    else if (dropdown_2.value == "sf") {
        input_2.value = input_1.value * 107639.104;
    }

    else if (dropdown_2.value == "sm") {
        input_2.value = input_1.value * 10000;
    }

    else if (dropdown_2.value == "sy") {
        input_2.value = input_1.value * 11959.9;
    }

    else if (dropdown_2.value == "acre") {
        input_2.value = input_1.value * 2.471;
    }

    else if (dropdown_2.value == "hectares") {
        input_2.value = input_1.value ;
    }

    else if (dropdown_2.value == "smile") {
        input_2.value = input_1.value / 258.999;
    }

    else if (dropdown_2.value == "skm") {
        input_2.value = input_1.value / 100;
        
    }
}


function squarekmconversions(){  

    if (dropdown_2.value == "si") {
        input_2.value = input_1.value * 1.55e+9;
        
    }

    else if (dropdown_2.value == "smm") {
        input_2.value = input_1.value * 1e+12;
    }

    else if (dropdown_2.value == "sf") {
        input_2.value = input_1.value * 1.076e+7;
    }

    else if (dropdown_2.value == "sm") {
        input_2.value = input_1.value * 1e+6;
    }

    else if (dropdown_2.value == "sy") {
        input_2.value = input_1.value * 1.196e+6;
    }

    else if (dropdown_2.value == "acre") {
        input_2.value = input_1.value * 247.105;
    }

    else if (dropdown_2.value == "hectares") {
        input_2.value = input_1.value * 100;
    }

    else if (dropdown_2.value == "smile") {
        input_2.value = input_1.value / 2.59;
    }

    else if (dropdown_2.value == "skm") {
        input_2.value = input_1.value;
        
    }

}


function squaremilesconversions(){
    
    if (dropdown_2.value == "si") {
        input_2.value = input_1.value * 4.014e+9;
        
    }

    else if (dropdown_2.value == "smm") {
        input_2.value = input_1.value * 2.59e+12;
    }

    else if (dropdown_2.value == "sf") {
        input_2.value = input_1.value * 2.788e+7;
    }

    else if (dropdown_2.value == "sm") {
        input_2.value = input_1.value * 2.59e+6;
    }

    else if (dropdown_2.value == "sy") {
        input_2.value = input_1.value * 3.098e+6;
    }

    else if (dropdown_2.value == "acre") {
        input_2.value = input_1.value * 640;
    }

    else if (dropdown_2.value == "hectares") {
        input_2.value = input_1.value * 258.999;
    }

    else if (dropdown_2.value == "smile") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "skm") {
        input_2.value = input_1.value * 2.59;
        
    }

}

// end area conversions



// start volume conversions

function fluidounceconversions(){
    
    if (dropdown_2.value == "fo") {
        input_2.value = input_1.value;
        
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value * 29.574;
    }

    else if (dropdown_2.value == "gln") {
        input_2.value = input_1.value / 128;
    }

    else if (dropdown_2.value == "ltr") {
        input_2.value = input_1.value / 33.814;
    }

    else if (dropdown_2.value == "cf") {
        input_2.value = input_1.value / 957.506;
    }

    else if (dropdown_2.value == "cy") {
        input_2.value = input_1.value / 25852.675;
    }

    else if (dropdown_2.value == "cm") {
        input_2.value = input_1.value / 33814.023;
    }

}

function mililitersconversions() {
    
    if (dropdown_2.value == "fo") {
        input_2.value = input_1.value / 29.574;
        
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "gln") {
        input_2.value = input_1.value / 3785.412;
    }

    else if (dropdown_2.value == "ltr") {
        input_2.value = input_1.value / 1000;
    }

    else if (dropdown_2.value == "cf") {
        input_2.value = input_1.value / 28316.847;
    }

    else if (dropdown_2.value == "cy") {
        input_2.value = input_1.value / 764554.858;
    }

    else if (dropdown_2.value == "cm") {
        input_2.value = input_1.value / 1e+6;
    }

}


function gallonsconversions() {
    
    if (dropdown_2.value == "fo") {
        input_2.value = input_1.value * 128;
        
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value * 3785.412;
    }

    else if (dropdown_2.value == "gln") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "ltr") {
        input_2.value = input_1.value * 3.785;
    }

    else if (dropdown_2.value == "cf") {
        input_2.value = input_1.value / 7.481;
    }

    else if (dropdown_2.value == "cy") {
        input_2.value = input_1.value / 201.974;
    }

    else if (dropdown_2.value == "cm") {
        input_2.value = input_1.value / 264.172;
    }

}


function litersconversions() {
    
    if (dropdown_2.value == "fo") {
        input_2.value = input_1.value * 33.814;
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value * 1000;
    }

    else if (dropdown_2.value == "gln") {
        input_2.value = input_1.value / 3.785;
    }

    else if (dropdown_2.value == "ltr") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "cf") {
        input_2.value = input_1.value / 28.317;
    }

    else if (dropdown_2.value == "cy") {
        input_2.value = input_1.value / 764.555;
    }

    else if (dropdown_2.value == "cm") {
        input_2.value = input_1.value / 1000;
    }

}


function cubicfeetsconversions() {
    
    if (dropdown_2.value == "fo") {
        input_2.value = input_1.value * 957.506;
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value * 28316.847;
    }

    else if (dropdown_2.value == "gln") {
        input_2.value = input_1.value * 7.481;
    }

    else if (dropdown_2.value == "ltr") {
        input_2.value = input_1.value * 28.317;
    }

    else if (dropdown_2.value == "cf") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "cy") {
        input_2.value = input_1.value / 27;
    }

    else if (dropdown_2.value == "cm") {
        input_2.value = input_1.value / 35.315;
    }

}


function cubicyardsconversions() {
    
    if (dropdown_2.value == "fo") {
        input_2.value = input_1.value * 25852.675;
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value * 764554.858;
    }

    else if (dropdown_2.value == "gln") {
        input_2.value = input_1.value * 201.974;
    }

    else if (dropdown_2.value == "ltr") {
        input_2.value = input_1.value * 764.555;
    }

    else if (dropdown_2.value == "cf") {
        input_2.value = input_1.value * 27;
    }

    else if (dropdown_2.value == "cy") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "cm") {
        input_2.value = input_1.value / 1.308;
    }

}


function cubicmeterconversions() {
    
    if (dropdown_2.value == "fo") {
        input_2.value = input_1.value * 33814.023;
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value * 1e+6;
    }

    else if (dropdown_2.value == "gln") {
        input_2.value = input_1.value * 264.1724;
    }

    else if (dropdown_2.value == "ltr") {
        input_2.value = input_1.value * 1000;
    }

    else if (dropdown_2.value == "cf") {
        input_2.value = input_1.value * 35.315;
    }

    else if (dropdown_2.value == "cy") {
        input_2.value = input_1.value * 1.308;
    }

    else if (dropdown_2.value == "cm") {
        input_2.value = input_1.value;
    }

}

// end volume conversions


// start mass conversions

function ouunceconversions(){

    if (dropdown_2.value == "on") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "gr") {
        input_2.value = input_1.value * 28.35;
    }

    else if (dropdown_2.value == "pnd") {
        input_2.value = input_1.value / 16;
    }

    else if (dropdown_2.value == "kg") {
        input_2.value = input_1.value / 35.274;
    }

    else if (dropdown_2.value == "st") {
        input_2.value = input_1.value / 32000;
    }

    else if (dropdown_2.value == "mg") {
        input_2.value = input_1.value / 35273.962;
    }
}

function gramsconversions(){

    if (dropdown_2.value == "on") {
        input_2.value = input_1.value / 28.35;
    }

    else if (dropdown_2.value == "gr") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "pnd") {
        input_2.value = input_1.value / 453.592;
    }

    else if (dropdown_2.value == "kg") {
        input_2.value = input_1.value / 1000;
    }

    else if (dropdown_2.value == "st") {
        input_2.value = input_1.value / 907184.74;
    }

    else if (dropdown_2.value == "mg") {
        input_2.value = input_1.value / 1e+6;
    }
}

function poundconversions(){

    if (dropdown_2.value == "on") {
        input_2.value = input_1.value * 16;
    }

    else if (dropdown_2.value == "gr") {
        input_2.value = input_1.value * 453.592;
    }

    else if (dropdown_2.value == "pnd") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "kg") {
        input_2.value = input_1.value / 2.205;
    }

    else if (dropdown_2.value == "st") {
        input_2.value = input_1.value / 2000;
    }

    else if (dropdown_2.value == "mg") {
        input_2.value = input_1.value / 2204.623;
    }
}

function kgconversions(){

    if (dropdown_2.value == "on") {
        input_2.value = input_1.value * 35.274;
    }

    else if (dropdown_2.value == "gr") {
        input_2.value = input_1.value * 1000;
    }

    else if (dropdown_2.value == "pnd") {
        input_2.value = input_1.value * 2.205;
    }

    else if (dropdown_2.value == "kg") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "st") {
        input_2.value = input_1.value / 907.185;
    }

    else if (dropdown_2.value == "mg") {
        input_2.value = input_1.value / 1000;
    }
}

function shorttonconversions(){

    if (dropdown_2.value == "on") {
        input_2.value = input_1.value * 32000;
    }

    else if (dropdown_2.value == "gr") {
        input_2.value = input_1.value * 907184.74;
    }

    else if (dropdown_2.value == "pnd") {
        input_2.value = input_1.value * 2000;
    }

    else if (dropdown_2.value == "kg") {
        input_2.value = input_1.value * 907.185;
    }

    else if (dropdown_2.value == "st") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "mg") {
        input_2.value = input_1.value / 1.102;
    }
}

function megagramconversions(){

    if (dropdown_2.value == "on") {
        input_2.value = input_1.value * 35273.962;
    }

    else if (dropdown_2.value == "gr") {
        input_2.value = input_1.value * 1e+6;
    }

    else if (dropdown_2.value == "pnd") {
        input_2.value = input_1.value * 2204.623;
    }

    else if (dropdown_2.value == "kg") {
        input_2.value = input_1.value * 1000;
    }

    else if (dropdown_2.value == "st") {
        input_2.value = input_1.value * 1.102;
    }

    else if (dropdown_2.value == "mg") {
        input_2.value = input_1.value;
    }
}


// start temp conversions

function celsiusconversions(){

    if (dropdown_2.value == "cls") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "fhr") {
        input_2.value = ((input_1.value * (9/5)) + 32);
    }

}

function fahrenheitconversions(){

    if (dropdown_2.value == "cls") {
        input_2.value = ((input_1.value - 32) * (5/9));
    }

    else if (dropdown_2.value == "fhr") {
        input_2.value = input_1.value;
    }

}

// end temprature conversions


// start lenght conversions

function inchconversions(){
    
    if (dropdown_2.value == "inch") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "mm") {
        input_2.value = input_1.value * 25.4;
    }

    else if (dropdown_2.value == "ft") {
        input_2.value = input_1.value / 12;
    }

    else if (dropdown_2.value == "m") {
        input_2.value = input_1.value / 39.37;
    }

    else if (dropdown_2.value == "yr") {
        input_2.value = input_1.value / 36;
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value / 63360;
    }

    else if (dropdown_2.value == "km") {
        input_2.value = input_1.value / 39370.079;
    }
}

function milimeterconversions(){
    
    if (dropdown_2.value == "inch") {
        input_2.value = input_1.value / 25.4;
    }

    else if (dropdown_2.value == "mm") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "ft") {
        input_2.value = input_1.value / 304.8;
    }

    else if (dropdown_2.value == "m") {
        input_2.value = input_1.value / 1000;
    }

    else if (dropdown_2.value == "yr") {
        input_2.value = input_1.value / 914.4;
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value / 1.609e+6;
    }

    else if (dropdown_2.value == "km") {
        input_2.value = input_1.value / 1e+6;
    }
}

function feetconversions(){
    
    if (dropdown_2.value == "inch") {
        input_2.value = input_1.value * 12;
    }

    else if (dropdown_2.value == "mm") {
        input_2.value = input_1.value * 304.8;
    }

    else if (dropdown_2.value == "ft") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "m") {
        input_2.value = input_1.value / 3.281;
    }

    else if (dropdown_2.value == "yr") {
        input_2.value = input_1.value / 3;
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value / 5280;
    }

    else if (dropdown_2.value == "km") {
        input_2.value = input_1.value / 3280.84;
    }
}

function meterconversions(){
    
    if (dropdown_2.value == "inch") {
        input_2.value = input_1.value * 39.37;
    }

    else if (dropdown_2.value == "mm") {
        input_2.value = input_1.value * 1000;
    }

    else if (dropdown_2.value == "ft") {
        input_2.value = input_1.value * 3.281;
    }

    else if (dropdown_2.value == "m") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "yr") {
        input_2.value = input_1.value * 1.094;
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value / 1609.344;
    }

    else if (dropdown_2.value == "km") {
        input_2.value = input_1.value / 1000;
    }
}

function yardsconversions(){
    
    if (dropdown_2.value == "inch") {
        input_2.value = input_1.value * 36;
    }

    else if (dropdown_2.value == "mm") {
        input_2.value = input_1.value * 914.4;
    }

    else if (dropdown_2.value == "ft") {
        input_2.value = input_1.value * 3;
    }

    else if (dropdown_2.value == "m") {
        input_2.value = input_1.value / 1.094;
    }

    else if (dropdown_2.value == "yr") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value / 1760;
    }

    else if (dropdown_2.value == "km") {
        input_2.value = input_1.value / 1093.613;
    }
}

function milesconversions(){
    
    if (dropdown_2.value == "inch") {
        input_2.value = input_1.value * 63360;
    }

    else if (dropdown_2.value == "mm") {
        input_2.value = input_1.value * 1.609e+6;
    }

    else if (dropdown_2.value == "ft") {
        input_2.value = input_1.value * 5280;
    }

    else if (dropdown_2.value == "m") {
        input_2.value = input_1.value * 1609.344;
    }

    else if (dropdown_2.value == "yr") {
        input_2.value = input_1.value * 1760;
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "km") {
        input_2.value = input_1.value * 1.609;
    }
}

function kilometersconversions(){
    
    if (dropdown_2.value == "inch") {
        input_2.value = input_1.value * 39370.079;
    }

    else if (dropdown_2.value == "mm") {
        input_2.value = input_1.value * 1e+6;
    }

    else if (dropdown_2.value == "ft") {
        input_2.value = input_1.value * 3280.84;
    }

    else if (dropdown_2.value == "m") {
        input_2.value = input_1.value * 1000;
    }

    else if (dropdown_2.value == "yr") {
        input_2.value = input_1.value * 1093.613;
    }

    else if (dropdown_2.value == "ml") {
        input_2.value = input_1.value / 1.609;
    }

    else if (dropdown_2.value == "km") {
        input_2.value = input_1.value;
    }
}

// end lenght conversions


// start currency conversions

function pkconversions(){
    
    if (dropdown_2.value == "pk") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "usd") {
        input_2.value = input_1.value / 142;
    }

    else if (dropdown_2.value == "ch") {
        input_2.value = input_1.value / 21.2;
    }

    else if (dropdown_2.value == "sr") {
        input_2.value = input_1.value / 38;
    }

}

function usdconversions(){
    
    if (dropdown_2.value == "pk") {
        input_2.value = input_1.value * 142;
    }

    else if (dropdown_2.value == "usd") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "ch") {
        input_2.value = input_1.value * 6.70;
    }

    else if (dropdown_2.value == "sr") {
        input_2.value = input_1.value * 3.75;
    }

}

function chinayuanconversions(){
    
    if (dropdown_2.value == "pk") {
        input_2.value = input_1.value * 21.2;
    }

    else if (dropdown_2.value == "usd") {
        input_2.value = input_1.value / 6.74;
    }

    else if (dropdown_2.value == "ch") {
        input_2.value = input_1.value;
    }

    else if (dropdown_2.value == "sr") {
        input_2.value = input_1.value * 0.56;
    }

}

function riyalconversions(){
    
    if (dropdown_2.value == "pk") {
        input_2.value = input_1.value * 38;
    }

    else if (dropdown_2.value == "usd") {
        input_2.value = input_1.value / 3.75;
    }

    else if (dropdown_2.value == "ch") {
        input_2.value = input_1.value / 0.56;
    }

    else if (dropdown_2.value == "sr") {
        input_2.value = input_1.value;
    }

}
// end currncy conversions


function clearme(){
    input_1.value = "";
    input_2.value = 0;
}