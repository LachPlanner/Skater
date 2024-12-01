import { PerspectiveCamera as ThreeJsCamera } from "three";

export default class PerspectiveCamera extends ThreeJsCamera {

    constructor(fov?: number, aspect?: number, near?: number, far?: number) {
        super(fov, aspect, near, far);

    }
}