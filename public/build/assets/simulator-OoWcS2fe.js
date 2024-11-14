const m={EDIT:0,MOVE:1,DELETE:2},f={NONE:0,NOT:1,AND:2,NAND:3,OR:4,NOR:5,XOR:6,XNOR:7},g={NONE:0,SR_LATCH_ASYNC:1,SR_LATCH_SYNC:2,FF_D_SINGLE:3,FF_D_MASTERSLAVE:4,FF_T:5,FF_JK:6},E={ASYNC:0,SYNC:1},v={FREE:0,TAKEN:1};let N=[],D=0,I=class{constructor(t,s,i=!1,o=!1){this.diameter=10,this.value=o,this.posX=t,this.posY=s,this.isOutput=i,this.hitRange=this.diameter+10,this.inputState=v.FREE,this.isAlive=!0,this.brotherNode=null,this.id=D,D++,N[this.id]=this}destroy(){this.isAlive=!1,delete N[this.id]}draw(){C(this.value),stroke(0),strokeWeight(4),circle(this.posX,this.posY,this.diameter),this.isMouseOver()&&(fill(128,128),noStroke(),circle(this.posX,this.posY,this.hitRange))}setID(t){delete N[this.id],this.id=t,N[this.id]=this,this.id>D&&(D=this.id+1)}setInputState(t){this.inputState=t}setBrother(t){this.brotherNode=t}getBrother(){return this.brotherNode}getValue(){return this.value}setValue(t){this.value=t}updatePosition(t,s){this.posX=t,this.posY=s}isMouseOver(){return dist(mouseX,mouseY,this.posX,this.posY)<this.hitRange/2}mouseClicked(){return this.isMouseOver()&&(this.inputState==v.FREE||this.isOutput)?(c.addNode(this),!0):!1}};function C(e){e?fill(255,193,7):fill(52,58,64)}class M{constructor(){this.value=!1,this.posX=mouseX,this.posY=mouseY,this.diameter=25,this.isSpawned=!1,this.isMoving=!1,this.offsetMouseX=0,this.offsetMouseY=0,this.output=new I(this.posX+30,this.posY,!0,this.value),this.nodeStartID=this.output.id,this.isSaved=!1}static from(t){return Object.assign(this,t)}destroy(){this.output.destroy(),delete this.output}draw(){this.isSpawned?this.isSaved||(X.saveState(),this.isSaved=!0):(this.posX=mouseX,this.posY=mouseY),C(this.value),this.isMoving&&(this.posX=mouseX+this.offsetMouseX,this.posY=mouseY+this.offsetMouseY),this.isMouseOver()?stroke(S[0],S[1],S[2]):stroke(0),strokeWeight(4),line(this.posX,this.posY,this.posX+30,this.posY),circle(this.posX,this.posY,this.diameter),this.output.updatePosition(this.posX+30,this.posY),this.output.setValue(this.value),this.output.draw(),this.printInfo(),textSize(18),this.value?(textStyle(BOLD),text("1",this.posX-this.diameter/4,this.posY+this.diameter/4)):(textStyle(NORMAL),fill(255),text("0",this.posX-this.diameter/4,this.posY+this.diameter/4))}refreshNodes(){let t=this.nodeStartID;this.output.setID(t)}printInfo(){noStroke(),fill(0),textSize(12),textStyle(NORMAL),text("LOG. INPUT",this.posX-20,this.posY+25)}isMouseOver(){return dist(mouseX,mouseY,this.posX,this.posY)<this.diameter/2}mousePressed(){if(!this.isSpawned){this.posX=mouseX,this.posY=mouseY,this.isSpawned=!0,_();return}(this.isMouseOver()||Y==m.MOVE)&&(this.isMoving=!0,this.offsetMouseX=this.posX-mouseX,this.offsetMouseY=this.posY-mouseY)}mouseReleased(){this.isMoving&&(this.isMoving=!1)}doubleClicked(){this.isMouseOver()&&(this.value^=!0)}mouseClicked(){return this.isMouseOver()||this.output.isMouseOver()?(this.output.mouseClicked(),!0):!1}toggle(){this.value^=!0}}class y extends M{constructor(t,s){super(),this.truePeriod=t*s/100,this.falsePeriod=t*(100-s)/100,this.lastTick=new Date().getTime(),this.strInfo=`CLOCK 
T = `+t+` ms
D% = `+s}draw(){const t=new Date().getTime(),s=this.value?this.truePeriod:this.falsePeriod;t-this.lastTick>s&&(this.toggle(),this.lastTick=t),super.draw()}printInfo(){noStroke(),fill(0),textSize(12),textStyle(NORMAL),text(this.strInfo,this.posX-20,this.posY+25)}}class k{constructor(){this.value=!1,this.posX=mouseX,this.posY=mouseY,this.diameter=25,this.isSpawned=!1,this.isMoving=!1,this.offsetMouseX=0,this.offsetMouseY=0,this.input=new I(this.posX-30,this.posY,!1,this.value),this.nodeStartID=this.input.id,this.isSaved=!1}destroy(){this.input.destroy(),delete this.input}draw(){this.isSpawned?this.isSaved||(X.saveState(),this.isSaved=!0):(this.posX=mouseX,this.posY=mouseY),this.isMoving&&(this.posX=mouseX+this.offsetMouseX,this.posY=mouseY+this.offsetMouseY),this.input.updatePosition(this.posX-30,this.posY),this.value=this.input.getValue(),C(this.value),this.isMouseOver()?stroke(S[0],S[1],S[2]):stroke(0),strokeWeight(4),line(this.posX,this.posY,this.posX-30,this.posY),circle(this.posX,this.posY,this.diameter),this.input.draw(),noStroke(),fill(0),textSize(12),textStyle(NORMAL),text("LOG. OUTPUT",this.posX-20,this.posY+25),textSize(18),this.value?(textStyle(BOLD),text("1",this.posX-this.diameter/4,this.posY+this.diameter/4)):(textStyle(NORMAL),fill(255),text("0",this.posX-this.diameter/4,this.posY+this.diameter/4))}refreshNodes(){let t=this.nodeStartID;this.input.setID(t)}isMouseOver(){return dist(mouseX,mouseY,this.posX,this.posY)<this.diameter/2}mousePressed(){if(!this.isSpawned){this.posX=mouseX,this.posY=mouseY,this.isSpawned=!0,_();return}(this.isMouseOver()||Y==m.MOVE)&&(this.isMoving=!0,this.offsetMouseX=this.posX-mouseX,this.offsetMouseY=this.posY-mouseY)}mouseReleased(){this.isMoving&&(this.isMoving=!1)}mouseClicked(){return this.isMouseOver()||this.input.isMouseOver()?(this.input.mouseClicked(),!0):!1}}class F{constructor(){this.isLoadingState=!1}saveState(){}loadString(t){this.isLoadingState=!0,h.splice(0,h.length),n.splice(0,n.length),l.splice(0,l.length),c.wire.splice(0,c.wire.length),p.splice(0,p.length),d.splice(0,d.length),u.splice(0,u.length),N.splice(0,N.length);let s=t;if("logicInput"in JSON.parse(s))for(let i=0;i<s.length;i++){let o=JSON.parse(s).logicInput[i];if(o==null)break;console.log(o),d.push(new M),Object.assign(d[i],o),d[i].refreshNodes()}if("logicOutput"in JSON.parse(s))for(let i=0;i<s.length;i++){let o=JSON.parse(s).logicOutput[i];if(o==null)break;console.log(o),u.push(new k),Object.assign(u[i],o),u[i].refreshNodes()}if("logicClock"in JSON.parse(s))for(let i=0;i<s.length;i++){let o=JSON.parse(s).logicClock[i];if(o==null)break;console.log(o),p.push(new y),Object.assign(p[i],o),p[i].refreshNodes()}if("gate"in JSON.parse(s))for(let i=0;i<s.length;i++){let o=JSON.parse(s).gate[i];if(o==null)break;console.log(o),l.push(new b(JSON.parse(s).gate[i].strType)),Object.assign(l[i],o),l[i].refreshNodes()}if("srLatch"in JSON.parse(s))for(let i=0;i<s.length;i++){let o=JSON.parse(s).srLatch[i];if(o==null)break;switch(console.log(o),JSON.parse(s).srLatch[i].type){case g.SR_LATCH_ASYNC:n.push(new SR_LatchAsync(JSON.parse(s).srLatch[i].gateType,JSON.parse(s).srLatch[i].stabilize));break;case g.SR_LATCH_SYNC:n.push(new SR_LatchSync(JSON.parse(s).srLatch[i].gateType,JSON.parse(s).srLatch[i].stabilize));break}Object.assign(n[i],o),n[i].refreshNodes()}if("flipflop"in JSON.parse(s))for(let i=0;i<s.length;i++){let o=JSON.parse(s).flipflop[i];if(o==null)break;switch(console.log(o),JSON.parse(s).flipflop[i].type){case g.FF_D_SINGLE:h.push(new FF_D_Single(JSON.parse(s).flipflop[i].type));break;case g.FF_D_MASTERSLAVE:h.push(new FF_D_MasterSlave(JSON.parse(s).flipflop[i].type));break;case g.FF_T:h.push(new FF_T(JSON.parse(s).flipflop[i].type));break;case g.FF_JK:h.push(new FF_JK(JSON.parse(s).flipflop[i].type));break}Object.assign(h[i],o),h[i].refreshNodes()}if("wire"in JSON.parse(s))for(let i=0;i<s.length;i++){let o=JSON.parse(s).wire[i];if(o==null)break;console.log(o),c.addNode(N[o.startID]),c.addNode(N[o.endID])}}loadFile(t){this.isLoadingState=!0,h.splice(0,h.length),n.splice(0,n.length),l.splice(0,l.length),c.wire.splice(0,c.wire.length),p.splice(0,p.length),d.splice(0,d.length),u.splice(0,u.length),N.splice(0,N.length);let s=t.target.files.item(0),i=new FileReader;i.onload=function(){let o=i.result;if("logicInput"in JSON.parse(o))for(let r=0;r<o.length;r++){let a=JSON.parse(o).logicInput[r];if(a==null)break;console.log(a),d.push(new M),Object.assign(d[r],a),d[r].refreshNodes()}if("logicOutput"in JSON.parse(o))for(let r=0;r<o.length;r++){let a=JSON.parse(o).logicOutput[r];if(a==null)break;console.log(a),u.push(new k),Object.assign(u[r],a),u[r].refreshNodes()}if("logicClock"in JSON.parse(o))for(let r=0;r<o.length;r++){let a=JSON.parse(o).logicClock[r];if(a==null)break;console.log(a),p.push(new y),Object.assign(p[r],a),p[r].refreshNodes()}if("gate"in JSON.parse(o))for(let r=0;r<o.length;r++){let a=JSON.parse(o).gate[r];if(a==null)break;console.log(a),l.push(new b(JSON.parse(o).gate[r].strType)),Object.assign(l[r],a),l[r].refreshNodes()}if("srLatch"in JSON.parse(o))for(let r=0;r<o.length;r++){let a=JSON.parse(o).srLatch[r];if(a==null)break;switch(console.log(a),JSON.parse(o).srLatch[r].type){case g.SR_LATCH_ASYNC:n.push(new SR_LatchAsync(JSON.parse(o).srLatch[r].gateType,JSON.parse(o).srLatch[r].stabilize));break;case g.SR_LATCH_SYNC:n.push(new SR_LatchSync(JSON.parse(o).srLatch[r].gateType,JSON.parse(o).srLatch[r].stabilize));break}Object.assign(n[r],a),n[r].refreshNodes()}if("flipflop"in JSON.parse(o))for(let r=0;r<o.length;r++){let a=JSON.parse(o).flipflop[r];if(a==null)break;switch(console.log(a),JSON.parse(o).flipflop[r].type){case g.FF_D_SINGLE:h.push(new FF_D_Single(JSON.parse(o).flipflop[r].type));break;case g.FF_D_MASTERSLAVE:h.push(new FF_D_MasterSlave(JSON.parse(o).flipflop[r].type));break;case g.FF_T:h.push(new FF_T(JSON.parse(o).flipflop[r].type));break;case g.FF_JK:h.push(new FF_JK(JSON.parse(o).flipflop[r].type));break}Object.assign(h[r],a),h[r].refreshNodes()}if("wire"in JSON.parse(o))for(let r=0;r<o.length;r++){let a=JSON.parse(o).wire[r];if(a==null)break;console.log(a),c.addNode(N[a.startID]),c.addNode(N[a.endID])}},i.readAsText(s)}saveFile(t){let s=F.getJSON_Workspace(),i=new Blob([s],{type:"application/json"});saveProjectFile.href=URL.createObjectURL(i)}static getJSON_Workspace(){let t=new Object;return t.logicInput=d,t.logicOutput=u,t.flipflop=h,t.logicClock=p,t.gate=l,t.srLatch=n,t.wire=c.wire,JSON.stringify(t,function(i,o){switch(i){case"output":case"input":case"nodeSet":case"nodeReset":case"nodeClock":case"nodeD":case"nodeT":case"nodeJ":case"nodeK":case"nodeQ":case"nodeNotQ":case"andGate_NotQ":case"andGate_Q":case"ff_D":case"orGate":case"gateSet":case"gateReset":case"asyncLatch":case"master":case"slave":case"srLatchSync":case"startNode":case"endNode":return}return o},"	")}}class b{constructor(t){this.strType=t,this.type=this.convertToType(t),this.width=w[this.type].width,this.height=w[this.type].height,this.posX=mouseX-this.width/2,this.posY=mouseY-this.height/2,this.isSpawned=!1,this.offsetMouseX=0,this.offsetMouseY=0,this.isMoving=!1,this.isSaved=!1,this.input=[],this.input.push(new I(this.posX,this.posY+15)),this.type!=f.NOT&&(this.input.push(new I(this.posX,this.posY+this.height-15)),this.input[0].setBrother(this.input[1]),this.input[1].setBrother(this.input[0])),this.output=new I(this.posX+this.width,this.posY+this.height/2,!0),this.nodeStartID=this.input[0].id}destroy(){for(let t=0;t<this.input.length;t++)this.input[t].destroy(),delete this.input[t];this.output.destroy(),delete this.output}draw(){this.isSpawned?this.isSaved||(X.saveState(),this.isSaved=!0):(this.posX=mouseX-this.width/2,this.posY=mouseY-this.height/2),this.isMoving&&(this.posX=mouseX+this.offsetMouseX,this.posY=mouseY+this.offsetMouseY),this.type==f.NOT?this.input[0].updatePosition(this.posX,this.posY+this.height/2):(this.input[0].updatePosition(this.posX,this.posY+15),this.input[1].updatePosition(this.posX,this.posY+this.height-15)),this.output.updatePosition(this.posX+this.width,this.posY+this.height/2),this.isMouseOver()&&(noFill(),strokeWeight(2),stroke(S[0],S[1],S[2]),rect(this.posX,this.posY,this.width,this.height)),image(w[this.type],this.posX,this.posY);for(let t=0;t<this.input.length;t++)this.input[t].draw();this.generateOutput(),this.output.draw()}refreshNodes(){let t=this.nodeStartID;this.input[0].setID(t),t++,this.type!=f.NOT&&(this.input[1].setID(t),t++),this.output.setID(t)}generateOutput(){this.output.setValue(this.calculateValue())}calculateValue(){switch(this.type){case f.NOT:return!this.input[0].getValue();case f.AND:return this.input[0].getValue()&&this.input[1].getValue();case f.NAND:return!(this.input[0].getValue()&&this.input[1].getValue());case f.OR:return this.input[0].getValue()||this.input[1].getValue();case f.NOR:return!(this.input[0].getValue()||this.input[1].getValue());case f.XOR:return this.input[0].getValue()^this.input[1].getValue();case f.XNOR:return!(this.input[0].getValue()^this.input[1].getValue())}}convertToType(t){switch(t){case"NOT":return f.NOT;case"AND":return f.AND;case"NAND":return f.NAND;case"OR":return f.OR;case"NOR":return f.NOR;case"XOR":return f.XOR;case"XNOR":return f.XNOR}}isMouseOver(){return mouseX>this.posX&&mouseX<this.posX+this.width&&mouseY>this.posY&&mouseY<this.posY+this.height}mousePressed(){if(!this.isSpawned){this.posX=mouseX-this.width/2,this.posY=mouseY-this.height/2,this.isSpawned=!0,_();return}(this.isMouseOver()||Y==m.MOVE)&&(this.isMoving=!0,this.offsetMouseX=this.posX-mouseX,this.offsetMouseY=this.posY-mouseY)}mouseReleased(){this.isMoving=!1}mouseClicked(){let t=this.isMouseOver();for(let s=0;s<this.input.length;s++)t|=this.input[s].mouseClicked();return t|=this.output.mouseClicked(),t}}let Y=m.EDIT;function L(e){if(T(),e.getAttribute("isGate")!=null){l.push(new b(e.getAttribute("tool")));return}switch(e.getAttribute("tool")){case"Edit":T();break;case"Move":Y=m.MOVE,document.getElementById("canvas-sim").style.cursor="move";break;case"Delete":Y=m.DELETE;break;case"LogicInput":d.push(new M),console.log(JSON.stringify({logicInput:d},["logicInput","posX","posY","value"]));break;case"LogicOutput":u.push(new k);break;case"Clock":let t=document.getElementsByClassName("period")[0].value,s=document.getElementsByClassName("duty-cycle")[0].value;p.push(new y(t,s));break;case"SR_Latch":{let i=document.getElementsByClassName("SR_Latch-gate")[0];const o=i.options[i.selectedIndex].text;i=document.getElementsByClassName("SR_Latch-sync")[0];const r=i.selectedIndex,a=document.getElementsByClassName("SR_stabilize")[0].checked;r==E.ASYNC?n.push(new SR_LatchAsync(SR_Latch.convertToType(o),a)):n.push(new SR_LatchSync(SR_Latch.convertToType(o),a))}break;case"FF_D":document.getElementsByClassName("FF_D-Setting")[0].selectedIndex?h.push(new FF_D_MasterSlave):h.push(new FF_D_Single);break;case"FF_T":document.getElementsByClassName("FF_T-Setting")[0].selectedIndex?h.push(new FF_T(!0)):h.push(new FF_T(!1));break;case"FF_JK":document.getElementsByClassName("FF_JK-Setting")[0].selectedIndex?h.push(new FF_JK(!0)):h.push(new FF_JK(!1));break}e.classList.add("active")}function T(){var t,s;Y=m.EDIT;let e=document.getElementsByClassName("active");for(let i=0;i<e.length;i++)(s=(t=e[i])==null?void 0:t.classList)==null||s.remove("active");document.getElementById("canvas-sim").style.cursor="default"}function _(){var e,t;T(),(t=(e=document.getElementsByClassName("Edit")[0])==null?void 0:e.classList)==null||t.add("active"),Y=m.EDIT}class R{constructor(t){this.startNode=t,this.endNode=null,this.startID=t.id,this.endID=null,this.endX=mouseX,this.endY=mouseY,this.width=8}destroy(){this.startNode.setInputState(v.FREE),this.endNode!=null&&(this.endNode.setValue(!1),this.endNode.setInputState(v.FREE))}draw(){if(stroke(0),strokeWeight(this.width/2),this.endNode==null){if(!this.startNode.isAlive)return!1;line(this.startNode.posX,this.startNode.posY,mouseX,mouseY)}else if(this.startNode.isAlive&&this.endNode.isAlive)this.generateNodeValue(),noFill(),this.isMouseOver()?stroke(S[0],S[1],S[2]):stroke(0),bezier(this.startNode.posX,this.startNode.posY,this.startNode.posX+50,this.startNode.posY,this.endNode.posX-50,this.endNode.posY,this.endNode.posX,this.endNode.posY),this.startNode.getValue()&&this.endNode.getValue()&&(strokeWeight(1),stroke(255,193,7),bezier(this.startNode.posX,this.startNode.posY,this.startNode.posX+50,this.startNode.posY,this.endNode.posX-50,this.endNode.posY,this.endNode.posX,this.endNode.posY));else return this.endNode.setValue(!1),!1;return!0}generateNodeValue(){this.startNode.isOutput&&this.endNode.isOutput||!this.startNode.isOutput&&!this.endNode.isOutput?(this.startNode.setValue(this.startNode.getValue()||this.endNode.getValue()),this.endNode.setValue(this.startNode.getValue())):this.endNode.setValue(this.startNode.getValue())}isMouseOver(){if(!this.startNode.isAlive||!this.endNode.isAlive)return!1;let t=[];t.push(dist(this.startNode.posX,this.startNode.posY,mouseX,mouseY)),t.push(dist(this.endNode.posX,this.endNode.posY,mouseX,mouseY));const s=dist(this.startNode.posX,this.startNode.posY,this.endNode.posX,this.endNode.posY);return t[0]+t[1]>=s-this.width/(10*2)&&t[0]+t[1]<=s+this.width/(10*2)}getStartNode(){return this.startNode}updateEnd(t,s){this.endX=t,this.endY=s}setEndNode(t){if(t.isOutput){let s=this.startNode;this.startNode=t,this.endNode=s,this.endNode.setInputState(v.TAKEN)}else this.endNode=t,this.startNode.setInputState(v.TAKEN),this.endNode.setInputState(v.TAKEN);this.startID=this.startNode.id,this.endID=this.endNode.id}}class A{constructor(t,s){this.firstNode=t,this.secondNode=s,this.inputNode=new Node(this.firstNode.posX-10,(this.firstNode.posY+this.secondNode.posY)/2),this.firstNode.setInputState(v.TAKEN),this.secondNode.setInputState(v.TAKEN)}destroy(){this.inputNode.destroy(),delete this.inputNode}draw(){if(stroke(0),strokeWeight(2),this.firstNode.isAlive&&this.secondNode.isAlive)this.drawShortCircuit(),this.inputNode.draw(),this.firstNode.setValue(this.inputNode.getValue()),this.secondNode.setValue(this.inputNode.getValue());else return this.firstNode.setValue(!1),this.secondNode.setValue(!1),!1;return!0}drawShortCircuit(){let t=[this.firstNode.posX-15,(this.firstNode.posY+this.secondNode.posY)/2];this.inputNode.updatePosition(t[0],t[1]),line(this.firstNode.posX,this.firstNode.posY,t[0],this.firstNode.posY),line(this.secondNode.posX,this.secondNode.posY,t[0],this.secondNode.posY),line(t[0],this.firstNode.posY,t[0],this.secondNode.posY)}mouseClicked(){this.inputNode.mouseClicked()}}class J{constructor(){this.wire=[],this.shortCircuit=[],this.isOpened=!1}draw(){for(let t=0;t<this.wire.length;t++)this.wire[t].draw()==!1&&(this.isOpened=!1,this.wire[t]!=null&&this.wire[t].destroy(),delete this.wire[t],this.wire.splice(t,1));for(let t=0;t<this.shortCircuit.length;t++)this.shortCircuit[t].draw()==!1&&(this.isOpened=!1,this.shortCircuit[t].destroy(),delete this.shortCircuit[t],this.shortCircuit.splice(t,1))}addNode(t){if(this.isOpened==!1)this.wire.push(new R(t)),this.isOpened=!0,document.getElementById("canvas-sim").style.cursor="crosshair";else{let s=this.wire.length-1;t!=this.wire[s].getStartNode()&&(this.wire[s].getStartNode().isOutput!=t.isOutput||t.getBrother()==this.wire[s].getStartNode())?t==this.wire[s].getStartNode().getBrother()?(this.shortCircuit.push(new A(this.wire[s].getStartNode(),t)),delete this.wire[s],this.wire.length--):(this.wire[s].setEndNode(t),X.saveState()):(delete this.wire[s],this.wire.length--),this.isOpened=!1,document.getElementById("canvas-sim").style.cursor="default"}}mouseClicked(){if(Y==m.DELETE)for(let t=0;t<this.wire.length;t++)this.wire[t].isMouseOver()&&(this.wire[t].destroy(),delete this.wire[t],this.wire.splice(t,1));for(let t=0;t<this.shortCircuit.length;t++)this.shortCircuit[t].mouseClicked()}}const V="/build/assets/LogicInput-DQW8fmdM.svg",P="/build/assets/NOT-1t5SPu-A.svg",j="/build/assets/AND-Dj6rWTSv.svg",x="/build/assets/NAND-DwcYmDUB.svg",B="/build/assets/OR-iGgT2ZRs.svg",U="/build/assets/NOR-BnoDjwLR.svg",W="/build/assets/XOR-Dqexxd3j.svg",K="/build/assets/XNOR-COqKfIhK.svg",z="/build/assets/SR_Latch-BGYJDW3Z.svg",G="/build/assets/SR_Latch_Sync-fe9o23iv.svg",H="/build/assets/FF_D-Bke9ZLDO.svg",Q="/build/assets/FF_D_MS-eYf0I0-a.svg",q="/build/assets/FF_T-CjeVMDAB.svg",Z="/build/assets/FF_JK-CyCNqYhm.svg";let w=[],O=[],l=[],d=[],u=[],p=[],n=[],h=[],c,S=[0,123,255],X=new F;function $(){w.push(loadImage(V)),w.push(loadImage(P)),w.push(loadImage(j)),w.push(loadImage(x)),w.push(loadImage(B)),w.push(loadImage(U)),w.push(loadImage(W)),w.push(loadImage(K)),O.push(loadImage(z)),O.push(loadImage(G)),O.push(loadImage(H)),O.push(loadImage(Q)),O.push(loadImage(q)),O.push(loadImage(Z))}function ee(){const e=windowHeight-90,t=windowWidth*.75;createCanvas(t,e,P2D).parent("canvas-sim"),document.getElementsByClassName("tools")[0].style.height=e,c=new J,X.loadString(`
{
	"logicInput": [
		{
			"value": 0,
			"posX": 64.5,
			"posY": 72,
			"diameter": 25,
			"isSpawned": true,
			"isMoving": false,
			"offsetMouseX": 7,
			"offsetMouseY": 7,
			"nodeStartID": 0,
			"isSaved": true
		},
		{
			"value": 0,
			"posX": 70.5,
			"posY": 241,
			"diameter": 25,
			"isSpawned": true,
			"isMoving": false,
			"offsetMouseX": 3,
			"offsetMouseY": 6,
			"nodeStartID": 1,
			"isSaved": true
		},
		{
			"value": 0,
			"posX": 60.5,
			"posY": 408,
			"diameter": 25,
			"isSpawned": true,
			"isMoving": false,
			"offsetMouseX": -6,
			"offsetMouseY": 5,
			"nodeStartID": 2,
			"isSaved": true
		}
	],
	"logicOutput": [
		{
			"value": 0,
			"posX": 1384.5,
			"posY": 436,
			"diameter": 25,
			"isSpawned": true,
			"isMoving": false,
			"offsetMouseX": -7,
			"offsetMouseY": 1,
			"nodeStartID": 34,
			"isSaved": true
		},
		{
			"value": false,
			"posX": 1278.5,
			"posY": 435,
			"diameter": 25,
			"isSpawned": true,
			"isMoving": false,
			"offsetMouseX": 2,
			"offsetMouseY": -3,
			"nodeStartID": 35,
			"isSaved": true
		}
	],
	"flipflop": [],
	"logicClock": [],
	"gate": [
		{
			"strType": "AND",
			"type": 2,
			"width": 100,
			"height": 50,
			"posX": -328.5,
			"posY": 280,
			"isSpawned": true,
			"offsetMouseX": -64,
			"offsetMouseY": -27,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 3
		},
		{
			"strType": "AND",
			"type": 2,
			"width": 100,
			"height": 50,
			"posX": 229.5,
			"posY": 153,
			"isSpawned": true,
			"offsetMouseX": -64,
			"offsetMouseY": -17,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 6
		},
		{
			"strType": "NOT",
			"type": 1,
			"width": 100,
			"height": 50,
			"posX": 372.5,
			"posY": 154,
			"isSpawned": true,
			"offsetMouseX": -32,
			"offsetMouseY": -10,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 9
		},
		{
			"strType": "AND",
			"type": 2,
			"width": 100,
			"height": 50,
			"posX": 511.5,
			"posY": 48,
			"isSpawned": true,
			"offsetMouseX": -57,
			"offsetMouseY": -21,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 11
		},
		{
			"strType": "AND",
			"type": 2,
			"width": 100,
			"height": 50,
			"posX": 519.5,
			"posY": 244,
			"isSpawned": true,
			"offsetMouseX": -37,
			"offsetMouseY": -21,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 14
		},
		{
			"strType": "OR",
			"type": 4,
			"width": 100,
			"height": 50,
			"posX": 724.5,
			"posY": 134,
			"isSpawned": true,
			"offsetMouseX": -96,
			"offsetMouseY": -18,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 17
		},
		{
			"strType": "AND",
			"type": 2,
			"width": 100,
			"height": 50,
			"posX": 749.5,
			"posY": 313,
			"isSpawned": true,
			"offsetMouseX": -56,
			"offsetMouseY": -22,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 20
		},
		{
			"strType": "NOT",
			"type": 1,
			"width": 100,
			"height": 50,
			"posX": 892.5,
			"posY": 312,
			"isSpawned": true,
			"offsetMouseX": -38,
			"offsetMouseY": -36,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 23
		},
		{
			"strType": "AND",
			"type": 2,
			"width": 100,
			"height": 50,
			"posX": 969.5,
			"posY": 157,
			"isSpawned": true,
			"offsetMouseX": -37,
			"offsetMouseY": -27,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 25
		},
		{
			"strType": "AND",
			"type": 2,
			"width": 100,
			"height": 50,
			"posX": 1008.5,
			"posY": 441,
			"isSpawned": true,
			"offsetMouseX": -43,
			"offsetMouseY": -9,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 28
		},
		{
			"strType": "OR",
			"type": 4,
			"width": 100,
			"height": 50,
			"posX": 1151.5,
			"posY": 278,
			"isSpawned": true,
			"offsetMouseX": -42,
			"offsetMouseY": -23,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 31
		},
		{
			"strType": "AND",
			"type": 2,
			"width": 100,
			"height": 50,
			"posX": 484.5,
			"posY": 591,
			"isSpawned": true,
			"offsetMouseX": -53,
			"offsetMouseY": -11,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 36
		},
		{
			"strType": "NOT",
			"type": 1,
			"width": 100,
			"height": 50,
			"posX": 630.5,
			"posY": 591,
			"isSpawned": true,
			"offsetMouseX": -37,
			"offsetMouseY": -20,
			"isMoving": false,
			"isSaved": true,
			"nodeStartID": 39
		}
	],
	"srLatch": [],
	"wire": [
		{
			"startID": 0,
			"endID": 6,
			"endX": 144.5,
			"endY": 63,
			"width": 8
		},
		{
			"startID": 1,
			"endID": 7,
			"endX": 138.5,
			"endY": 219,
			"width": 8
		},
		{
			"startID": 8,
			"endID": 9,
			"endX": 317.5,
			"endY": 139,
			"width": 8
		},
		{
			"startID": 0,
			"endID": 11,
			"endX": 141.5,
			"endY": 66,
			"width": 8
		},
		{
			"startID": 10,
			"endID": 12,
			"endX": 488.5,
			"endY": 182,
			"width": 8
		},
		{
			"startID": 1,
			"endID": 15,
			"endX": 133.5,
			"endY": 215,
			"width": 8
		},
		{
			"startID": 10,
			"endID": 14,
			"endX": 492.5,
			"endY": 179,
			"width": 8
		},
		{
			"startID": 13,
			"endID": 17,
			"endX": 632.5,
			"endY": 71,
			"width": 8
		},
		{
			"startID": 16,
			"endID": 18,
			"endX": 632.5,
			"endY": 268,
			"width": 8
		},
		{
			"startID": 22,
			"endID": 23,
			"endX": 1010.5,
			"endY": 349,
			"width": 8
		},
		{
			"startID": 33,
			"endID": 34,
			"endX": 1311.5,
			"endY": 308,
			"width": 8
		},
		{
			"startID": 27,
			"endID": 31,
			"endX": 1185.5,
			"endY": 216,
			"width": 8
		},
		{
			"startID": 30,
			"endID": 32,
			"endX": 1265.5,
			"endY": 428,
			"width": 8
		},
		{
			"startID": 19,
			"endID": 25,
			"endX": 824.5,
			"endY": 157,
			"width": 8
		},
		{
			"startID": 19,
			"endID": 20,
			"endX": 820.5,
			"endY": 152,
			"width": 8
		},
		{
			"startID": 24,
			"endID": 26,
			"endX": 1083.5,
			"endY": 331,
			"width": 8
		},
		{
			"startID": 24,
			"endID": 28,
			"endX": 1081.5,
			"endY": 328,
			"width": 8
		},
		{
			"startID": 2,
			"endID": 21,
			"endX": 136.5,
			"endY": 476,
			"width": 8
		},
		{
			"startID": 2,
			"endID": 29,
			"endX": 131.5,
			"endY": 479,
			"width": 8
		},
		{
			"startID": 40,
			"endID": 35,
			"endX": 1234.5,
			"endY": 637,
			"width": 8
		},
		{
			"startID": 10,
			"endID": 37,
			"endX": 476.5,
			"endY": 180,
			"width": 8
		},
		{
			"startID": 38,
			"endID": 39,
			"endX": 1144.5,
			"endY": 538,
			"width": 8
		},
		{
			"startID": 24,
			"endID": 36,
			"endX": 1083.5,
			"endY": 328,
			"width": 8
		}
	]
}
`)}function te(){const e=windowHeight-90;resizeCanvas(windowWidth-115,e),document.getElementsByClassName("tools")[0].style.height=e}function se(){background(255),stroke(0),strokeWeight(4),fill(255),rect(0,0,width,height),c.draw();for(let e=0;e<l.length;e++)l[e].draw();for(let e=0;e<d.length;e++)d[e].draw();for(let e=0;e<u.length;e++)u[e].draw();for(let e=0;e<p.length;e++)p[e].draw();for(let e=0;e<n.length;e++)n[e].draw();for(let e=0;e<h.length;e++)h[e].draw();X.isLoadingState&&(X.isLoadingState=!1)}function ie(){for(let e=0;e<l.length;e++)l[e].mousePressed();for(let e=0;e<d.length;e++)d[e].mousePressed();for(let e=0;e<u.length;e++)u[e].mousePressed();for(let e=0;e<p.length;e++)p[e].mousePressed();for(let e=0;e<n.length;e++)n[e].mousePressed();for(let e=0;e<h.length;e++)h[e].mousePressed()}function oe(){for(let e=0;e<l.length;e++)l[e].mouseReleased();for(let e=0;e<d.length;e++)d[e].mouseReleased();for(let e=0;e<u.length;e++)u[e].mouseReleased();for(let e=0;e<p.length;e++)p[e].mouseReleased();for(let e=0;e<n.length;e++)n[e].mouseReleased();for(let e=0;e<h.length;e++)h[e].mouseReleased()}function re(){for(let e=0;e<d.length;e++)d[e].doubleClicked()}function he(){if(Y==m.EDIT){for(let e=0;e<l.length;e++)l[e].mouseClicked();for(let e=0;e<d.length;e++)d[e].mouseClicked();for(let e=0;e<u.length;e++)u[e].mouseClicked();for(let e=0;e<p.length;e++)p[e].mouseClicked();for(let e=0;e<n.length;e++)n[e].mouseClicked();for(let e=0;e<h.length;e++)h[e].mouseClicked()}else if(Y==m.DELETE){for(let e=0;e<l.length;e++)l[e].mouseClicked()&&(l[e].destroy(),delete l[e],l.splice(e,1));for(let e=0;e<d.length;e++)d[e].mouseClicked()&&(d[e].destroy(),delete d[e],d.splice(e,1));for(let e=0;e<u.length;e++)u[e].mouseClicked()&&(u[e].destroy(),delete u[e],u.splice(e,1));for(let e=0;e<p.length;e++)p[e].mouseClicked()&&(p[e].destroy(),delete p[e],p.splice(e,1));for(let e=0;e<n.length;e++)n[e].mouseClicked()&&(n[e].destroy(),delete n[e],n.splice(e,1));for(let e=0;e<h.length;e++)h[e].mouseClicked()&&(h[e].destroy(),delete h[e],h.splice(e,1))}c.mouseClicked()}window.preload=$;window.setup=ee;window.draw=se;window.windowResized=te;window.mousePressed=ie;window.mouseReleased=oe;window.doubleClicked=re;window.mouseClicked=he;window.activeTool=L;document.getElementById("projectFile").addEventListener("change",X.loadFile,!1);document.getElementById("saveProjectFile").addEventListener("click",X.saveFile,!1);
