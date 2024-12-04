import { PerspectiveCamera } from "three";
import { OrbitControls as ThreeJsOrbitControls } from "three/examples/jsm/controls/OrbitControls";

export default class OrbitControls extends ThreeJsOrbitControls {

    constructor(object: PerspectiveCamera, domElement: HTMLElement) {
        super(object, domElement);
    }

    public updateTarget(x: number, y: number, z: number) {
        this.target.set(x, y, z); 
    }
}