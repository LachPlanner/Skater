import { PerspectiveCamera as ThreeJsCamera, Vector3 } from "three";


export default class PerspectiveCamera extends ThreeJsCamera {
    constructor(fov?: number, aspect?: number, near?: number, far?: number) {
        super(fov, aspect, near, far);
    }

    public updateCameraPosition(x: number, y: number, z: number): void {
        this.position.set(x, y, z);
    }

    public updateCameraTarget(x: number, y: number, z: number) {
        this.lookAt(x, y, z);
    }
}