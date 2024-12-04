import { WebGLRenderer as ThreeJsWebGLRenderer } from "three";

export default class WebGLRenderer extends ThreeJsWebGLRenderer {

    constructor(alpha?: boolean, antialias?: boolean) {
        super({alpha: alpha, antialias: antialias});
    }
}