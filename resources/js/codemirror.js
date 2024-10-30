import { EditorView, basicSetup } from 'codemirror';
import { python } from '@codemirror/lang-python';
import { tokyoNight } from '@uiw/codemirror-theme-tokyo-night';

window.EditorView = EditorView;
window.basicSetup = basicSetup;
window.tokyoNight = tokyoNight;
window.python = python;
