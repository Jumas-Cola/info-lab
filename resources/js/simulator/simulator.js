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
  let canvasWidth = windowWidth - 315;
  if (windowWidth < 500) {
    canvasWidth = windowWidth - 155;
  } else if (windowWidth < 700) {
    canvasWidth = windowWidth - 215;
  }
  let canvas = createCanvas(canvasWidth, canvHeight, P2D);

  canvas.parent('canvas-sim');
  document.getElementsByClassName('tools')[0].style.height = canvHeight;

  wireMng = new WireManager();
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
