import { AmbientLight as ThreeJsAmbientLight } from "three";
import { Engine } from "@/System/Engine";

export default class AmbientLight extends ThreeJsAmbientLight {
    constructor(engine: Engine, color: number = 0x333333, intensity: number = 0) {
        super(color, intensity);

        // Tilføj lyset til scenen
        engine.scene.add(this);
    }
}