import { PerspectiveCamera } from "three";
import { OrbitControls as ThreeJsOrbitControls } from "three/examples/jsm/controls/OrbitControls";

export default class OrbitControls extends ThreeJsOrbitControls {

    constructor(object: PerspectiveCamera, domElement: HTMLElement) {
        super(object, domElement);
    }

    public updateTarget(x: number, y: number, z: number) {
        this.target.set(x, y, z); 
    }

    public updateAzimuthAngle(angle: number): void {
        this.maxAzimuthAngle = angle;
        this.minAzimuthAngle = - angle;
    }

    public updateMaxPolarAngle(angle: number) {
        this.maxPolarAngle = angle;
    }

    public updateMinPolarAngle(angle:number) {
        this.minPolarAngle = angle;
    }    
}