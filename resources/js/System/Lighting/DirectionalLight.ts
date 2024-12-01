import { DirectionalLight as ThreeJsDirectionalLight } from "three";
import { Engine } from "@/System/Engine";

export default class DirectionalLight extends ThreeJsDirectionalLight {
    constructor(engine: Engine, color: number = 0xffffff, intensity: number = 1) {
        super(color, intensity);

        // Tilføj lyset til scenen
        engine.scene.add(this);
        this.position.set(0, 2, 4)
    }
}