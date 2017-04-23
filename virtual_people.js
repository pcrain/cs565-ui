var color  = ["#000000","#FF0000","#00FF00","#FFFFFF"];
var status = ["not started","inactive","active","completed"];

var namechance = new Chance("nameseed");
var unames = namechance.unique(namechance.first, 300);
// alert(unames);
var chance = new Chance();

var nSims             = 15;
var avgCompletionTime = 0.15; //minutes
var nMaxWords         = 300;
var timeInterval      = 1; //seconds

var dt = new Date(); var secs = dt.getSeconds() + (60 * dt.getMinutes()) + (60 * 60 * dt.getHours());
// alert(secs);
var startIndex = Math.floor( ((nSims*secs)/(60*avgCompletionTime)) % unames.length);
// alert(unames[startIndex]);

var group1a = {      //arrived early, average focus, persistence, and speed
    latencyMean : 0,
    focusMean   : 3/5,
    persistenceMean : 3/5,
    speedMean : 0
};

var group2a = {      //arrived early, low focus and persistence, but average speed
    latencyMean : 0,
    focusMean   : 2/5,
    persistenceMean : 1/5,
    speedMean : 0
};

var group3a = {      //arrived early, low focus and persistence, but fast speed
    latencyMean : 0,
    focusMean   : 2/5,
    persistenceMean : 1/5,
    speedMean : 0.50
};

var group4a = {      //arrived within three minutes, average focus but lower persistence and slow speed
    latencyMean : 1/3,
    focusMean   : 3/5,
    persistenceMean : 2/5,
    speedMean : -0.20
};

var group5a = {      //arrived later, good focus but lower persistence and average speed
    latencyMean : 7/10,
    focusMean   : 4/5,
    persistenceMean : 2/5,
    speedMean : 0.00
};

var group6a = {      //arrived later, average focus and lower persistence, but fast speed
    latencyMean : 7/10,
    focusMean   : 4/5,
    persistenceMean : 2/5,
    speedMean : 0.20
};

var group1b = {
    latencyMean : 9/10,
    focusMean   : 1/10,
    persistenceMean : 1/10,
    speedMean : 0.00
}

// var groups  = [group1,group2,group3,group4,group5,group6]
var groups  = [group1b,group1b,group1b,group1b,group1b,group1b]
var weights = [1,1,1,1,1,1];
var sumW    = weights.reduce((a,b) => a+b);
weights     = weights.map(x => x/sumW);

class HMM
{
    constructor(p_init,p_trans,callback){

        if (p_trans.length != Math.pow(p_init.length,2)){
            throw('error: state parameters does not match');
        } else{
            this.nStates = p_init.length;
        }

        this.stateVars = Array.from(new Array(this.nStates), (v,ind) => ind);
        this.state     = chance.weighted(this.stateVars, p_init);
        this.transMat  = p_trans;

        if (callback !== undefined){
            this.callback = callback;
        }

        return this;
    }

    tick(){
        if (this.callback === undefined){
            var p_trans = this.p_transition();
            this.state  = chance.weighted(this.stateVars, p_trans);
        } else{
            if (this.callback(this.state)){
                var p_trans = this.p_transition();
                this.state  = chance.weighted(this.stateVars, p_trans);
            }
        }
    }

    p_transition(){
        var row = this.state *this.nStates;

        return this.stateVars.map(
            ind => this.transMat[row + ind]
        );
    }
}





class Sim{
    constructor(name,latency,focus,persistence,speed,avgProgressPerTick){
        if (latency < 0 || latency > 0.95)
            throw('error: latency should have a value between 0 and 0.95');
        if (focus > 1 || focus < 0)
            throw('error: focus should have a value between 0 and 1');
        if (persistence > 1 || persistence < 0.1)
            throw('error: persistence should have a value between 0.1 and 1');
        if (speed < -0.9 || speed > 0.9)
            throw('sim_speed is a float variable between -0.9 to 0.9');

        this.name     = name;
        this.state    = 0;
        this.progress = 0;

        this.latency = latency;
        this.focus       = focus;
        this.persistence = persistence;
        this.speed       = speed;
        this.avgProgress = avgProgressPerTick;
    }
}


Sim.prototype.initSpeedHMM = function(progressPerTick){
    var p_init    = [0.30,0.2,0.1,0.2,0.30];
    var p_transit = [0.60,0.30,0.10,0.00,0.00,
                     0.20,0.35,0.45,0.00,0.00,
                     0.05,0.15,0.60,0.15,0.05,
                     0.00,0.00,0.45,0.35,0.20,
                     0.00,0.00,0.10,0.30,0.60
                    ];

    this.speedHMM = new HMM(p_init,p_transit);

    var progressSpeed   = Math.min(this.speed+1, 1-this.speed);
    var simProgress     = (1+this.speed)*progressPerTick;
    this.progressStates = [simProgress*(1-2*progressSpeed/3),
                           simProgress*(1-progressSpeed/3),
                           simProgress,
                           simProgress*(1+progressSpeed/3),
                           simProgress*(1+2*progressSpeed/3)
                          ];
}

Sim.prototype.initActivityHMM = function(){

    var p_init    = [0, 1];
    var p_transit = [1-this.persistence, this.persistence,
                     1-this.focus      , this.focus
                    ];

    this.activityHMM = new HMM(p_init,p_transit);
}

Sim.prototype.tick = function(){
    if (this.state == 0){
        var started = chance.weighted([false,true],[this.latency, 1-this.latency]);

        if (started){
            this.initActivityHMM();

            if (this.latency == 0){
                if (chance.pickone([true,false])){
                    this.progress += chance.normal({mean:25, dev:15});  // IF ALREADY STARTED
                    this.activityHMM.state = chance.pickone([0,1]);
                }
                else{
                    this.progress += 0;
                }
            }

            this.state = this.activityHMM.state + 1;
            this.initSpeedHMM(this.avgProgress);
        }

    } else{
        if (this.state == 2){
            this.progress += this.progressStates[this.speedHMM.state];
            this.speedHMM.tick();
        }

        if (this.progress < 100){
            this.activityHMM.tick();
            this.state = this.activityHMM.state + 1;
        } else{
            this.state = 3;
        }
    }
}


function testSim()
{
    var late   = [0,0.1,0.25,0.5,0.75,0.9];
    var foc    = [0,0.1,0.25,0.5,0.75,0.9,1];
    var per    = [0.1,0.25,0.5,0.75,0.9,1];
    var spd    = [-0.9,-0.75,-.25,0,0.25,0.75,0.9];
    var avgPPT = [1,2,3,5,8,13,21,34];

    var sttNames = ['late','rest','work','complete'];

//constructor(name,latency,focus,persistence,speed,avgProgressPerTick)
    simsim = new Sim('Test',7/10,4/5,2/5,0.00,10);
    sttString  = '';
    progString = '';
    while(simsim.state != 3){
        simsim.tick();
        sttString  += (sttNames[simsim.state] + ' ');
        progString += (('0'+Math.floor(simsim.progress)).slice(-2) + '   ');
        console.log(sttString);
        console.log(progString);
//            debugger
    }
}



class Simulator
{
    constructor (groups, weights, nSims, avgCompletionTime, timeInterval, nMaxWords){
        this.nSims    = nSims;
        this.theSims  = [];
        this.nWords   = [];
        this.simState = [];

        var avgProgressPerTick = 100*timeInterval/(avgCompletionTime*60);

        // var simNames = chance.unique(chance.first, this.nSims);
        var groupNum = Array.from(Array(this.nSims), (v,ind) => ind).map(
            v => chance.weighted(Array.from(weights, (vv,i) => i), weights)
        );


        for (var i = 0; i < this.nSims; i++){
            var ind = groupNum[i];
            this.theSims.push(
                new Sim(unames[startIndex+i], groups[ind].latencyMean, groups[ind].focusMean, groups[ind].persistenceMean, groups[ind].speedMean, avgProgressPerTick)
            );

            this.nWords.push(Math.floor(chance.normal({mean: nMaxWords, dev: 1/5*nMaxWords})) );
        }
    }

    tick(){
        // alert(chance.integer({min: 0, max: 100}));

        var output = [];
        for (var i = 0; i < this.nSims; i++){
            var sim = this.theSims[i];
            sim.tick();
            if (sim.progress >= 100) {
                if (chance.integer({min: 0, max: 100}) < 10) {
                    var dt = new Date(); var secs = dt.getSeconds() + (60 * dt.getMinutes()) + (60 * 60 * dt.getHours());
                    var newIndex = Math.floor( ((this.nSims*secs)/(60*avgCompletionTime)) % unames.length);
                    if (newIndex != startIndex) {
                        sim.progress = 0;
                        sim.state = 0;
                        sim.name = unames[this.nSims+startIndex];
                        startIndex = (startIndex + 1) % unames.length;
                    }
                }
            }
            output.push({
                state    : sim.state,
                progress : sim.progress,
                nWords   : Math.floor(sim.progress/100 *this.nWords[i]),
                status   : status[sim.state],
                color    : color[sim.state],
                name     : sim.name,
            });
        }

        this.simState = output;
        genUsers(this.simState);

        var disp = output.map(s => s.nWords);
        // console.log(disp);
    }
}


function tick(simsim){
    if ($("body").hasClass("modal-open")) {
        return;
    }
    simsim.tick()
}

var simulator = new Simulator(groups, weights, nSims, avgCompletionTime, timeInterval, nMaxWords);
simulator.tick();

tick(simulator);
setInterval(function(){tick(simulator);}, timeInterval*1000);

//var tickEvent = new Event('tick');
//window.addEventListener('tick', simulator.tick())



//
//class Simulator extends Sim
//{
//    constructor(duration,maxWords,updateFreq){
//        this._duration    = duration;
//        this._maxWords    = maxWords;
//        this._currentTime = totalTime;
//        this._updateFreq  = updateFreq;
//        this._totalInactive = 0;
//        this._simsList    = [];
//    }
//
//    addSim(name,progress,activeTime,timeRequired,nInactive,status){
//        _simsList.push(new Sim(name,progress,activeTime,timeRequired,nInactive,status) );
//        this._totalInactive += nInactive;
//    }
//
//    initializeSimActivity(){
//        var deltaT = this._duration*60/this._updateFreq /this._totalInactive;
//
//    }
//
//    updateSims(){
//        for (var s in _simsList){
//            var sim = _simsList[s];
//            if (sim._status == "active"){
//                sim._activeTime += this._updateFreq;
//
//                switch (sim._speed){
//                    case 0:
//
//                }
//
//                sim._progress
//            }
//        }
//    }
//}
