import { activeTool, currMouseAction } from './menutools';
import { MouseAction } from './circuit_components/Enums';
import { WireManager } from './circuit_components/Wire';
import { FileManager } from './FileManager';

import logicInputUrl from '../../images/simulator/LogicInput.svg';
import notUrl from '../../images/simulator/NOT.svg';
import andUrl from '../../images/simulator/AND.svg';
import nandUrl from '../../images/simulator/NAND.svg';
import orUrl from '../../images/simulator/OR.svg';
import norUrl from '../../images/simulator/NOR.svg';
import xorUrl from '../../images/simulator/XOR.svg';
import xnorUrl from '../../images/simulator/XNOR.svg';

import srLatchUrl from '../../images/simulator/SR_Latch.svg';
import srLatchSyncUrl from '../../images/simulator/SR_Latch_Sync.svg';
import ffdUrl from '../../images/simulator/FF_D.svg';
import ffdMsUrl from '../../images/simulator/FF_D_MS.svg';
import fftUrl from '../../images/simulator/FF_T.svg';
import ffjUrl from '../../images/simulator/FF_JK.svg';

export let gateIMG = []; // gates images
export let IC_IMG = []; // integrated circuits images
export let gate = [];
export let logicInput = [];
export let logicOutput = [];
export let logicClock = [];
export let srLatch = [];
export let flipflop = [];
export let wireMng;
export let colorMouseOver = [0, 0x7b, 0xff];
export let fileManager = new FileManager();

/**
 * @todo TODO
 */
export function preload() {
  gateIMG.push(loadImage(logicInputUrl)); // For testing usage
  gateIMG.push(loadImage(notUrl));
  gateIMG.push(loadImage(andUrl));
  gateIMG.push(loadImage(nandUrl));
  gateIMG.push(loadImage(orUrl));
  gateIMG.push(loadImage(norUrl));
  gateIMG.push(loadImage(xorUrl));
  gateIMG.push(loadImage(xnorUrl));

  IC_IMG.push(loadImage(srLatchUrl)); // For testing usage
  IC_IMG.push(loadImage(srLatchSyncUrl));
  IC_IMG.push(loadImage(ffdUrl));
  IC_IMG.push(loadImage(ffdMsUrl));
  IC_IMG.push(loadImage(fftUrl));
  IC_IMG.push(loadImage(ffjUrl));
}

/**
 * @todo TODO
 */
export function setup() {
  const canvHeight = windowHeight - 90;
  const canvasWidth = Math.max(windowWidth * 0.75, 1500);
  let canvas = createCanvas(canvasWidth, canvHeight, P2D);

  canvas.parent('canvas-sim');
  document.getElementsByClassName('tools')[0].style.height = canvHeight;

  wireMng = new WireManager();

  fileManager.loadString(`
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
`);
}

/**
 * @todo TODO
 */
export function windowResized() {
  const canvHeight = windowHeight - 90;
  resizeCanvas(windowWidth - 115, canvHeight);
  document.getElementsByClassName('tools')[0].style.height = canvHeight;
}

/**
 * @todo TODO
 */
export function draw() {
  background(0xff);
  stroke(0);
  strokeWeight(4);
  fill(0xff);
  rect(0, 0, width, height);

  wireMng.draw();

  for (let i = 0; i < gate.length; i++) gate[i].draw();

  for (let i = 0; i < logicInput.length; i++) logicInput[i].draw();

  for (let i = 0; i < logicOutput.length; i++) logicOutput[i].draw();

  for (let i = 0; i < logicClock.length; i++) logicClock[i].draw();

  for (let i = 0; i < srLatch.length; i++) srLatch[i].draw();

  for (let i = 0; i < flipflop.length; i++) flipflop[i].draw();

  if (fileManager.isLoadingState) fileManager.isLoadingState = false;
}

/**
 * While mouse is pressed:
 *
 */
export function mousePressed() {
  /** Check gate[] mousePressed funtion*/
  for (let i = 0; i < gate.length; i++) gate[i].mousePressed();

  for (let i = 0; i < logicInput.length; i++) logicInput[i].mousePressed();

  for (let i = 0; i < logicOutput.length; i++) logicOutput[i].mousePressed();

  for (let i = 0; i < logicClock.length; i++) logicClock[i].mousePressed();

  for (let i = 0; i < srLatch.length; i++) srLatch[i].mousePressed();

  for (let i = 0; i < flipflop.length; i++) flipflop[i].mousePressed();
}

/**
 * @todo TODO
 */
export function mouseReleased() {
  for (let i = 0; i < gate.length; i++) gate[i].mouseReleased();

  for (let i = 0; i < logicInput.length; i++) logicInput[i].mouseReleased();

  for (let i = 0; i < logicOutput.length; i++) logicOutput[i].mouseReleased();

  for (let i = 0; i < logicClock.length; i++) logicClock[i].mouseReleased();

  for (let i = 0; i < srLatch.length; i++) srLatch[i].mouseReleased();

  for (let i = 0; i < flipflop.length; i++) flipflop[i].mouseReleased();
}

/**
 * @todo TODO
 */
export function doubleClicked() {
  for (let i = 0; i < logicInput.length; i++) logicInput[i].doubleClicked();
}

/**
 * Override mouseClicked Function
 *
 */
export function mouseClicked() {
  //Check current selected option
  if (currMouseAction == MouseAction.EDIT) {
    //If action is EDIT, check every class.
    for (let i = 0; i < gate.length; i++) gate[i].mouseClicked();

    for (let i = 0; i < logicInput.length; i++) logicInput[i].mouseClicked();

    for (let i = 0; i < logicOutput.length; i++) logicOutput[i].mouseClicked();

    for (let i = 0; i < logicClock.length; i++) logicClock[i].mouseClicked();

    for (let i = 0; i < srLatch.length; i++) srLatch[i].mouseClicked();

    for (let i = 0; i < flipflop.length; i++) flipflop[i].mouseClicked();
  } else if (currMouseAction == MouseAction.DELETE) {
    //
    for (let i = 0; i < gate.length; i++) {
      if (gate[i].mouseClicked()) {
        gate[i].destroy();
        delete gate[i];
        gate.splice(i, 1);
      }
    }

    for (let i = 0; i < logicInput.length; i++) {
      if (logicInput[i].mouseClicked()) {
        logicInput[i].destroy();
        delete logicInput[i];
        logicInput.splice(i, 1);
      }
    }

    for (let i = 0; i < logicOutput.length; i++) {
      if (logicOutput[i].mouseClicked()) {
        logicOutput[i].destroy();
        delete logicOutput[i];
        logicOutput.splice(i, 1);
      }
    }

    for (let i = 0; i < logicClock.length; i++) {
      if (logicClock[i].mouseClicked()) {
        logicClock[i].destroy();
        delete logicClock[i];
        logicClock.splice(i, 1);
      }
    }

    for (let i = 0; i < srLatch.length; i++) {
      if (srLatch[i].mouseClicked()) {
        srLatch[i].destroy();
        delete srLatch[i];
        srLatch.splice(i, 1);
      }
    }

    for (let i = 0; i < flipflop.length; i++) {
      if (flipflop[i].mouseClicked()) {
        flipflop[i].destroy();
        delete flipflop[i];
        flipflop.splice(i, 1);
      }
    }
  }
  wireMng.mouseClicked();
}

window.preload = preload;
window.setup = setup;
window.draw = draw;
window.windowResized = windowResized;
window.mousePressed = mousePressed;
window.mouseReleased = mouseReleased;
window.doubleClicked = doubleClicked;
window.mouseClicked = mouseClicked;

window.activeTool = activeTool;

document
  .getElementById('projectFile')
  .addEventListener('change', fileManager.loadFile, false);
document
  .getElementById('saveProjectFile')
  .addEventListener('click', fileManager.saveFile, false);

/**
 * Call FileManager.saveFile
 */
export function saveFile() {
  fileManager.saveFile();
}
