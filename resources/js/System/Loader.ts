import { GLTFLoader } from "three/examples/jsm/loaders/GLTFLoader";
import { Object3D } from "three";
import { Engine } from "@/System/Engine";

export default class Loader extends GLTFLoader {
    private engine: Engine;

    constructor(engine: Engine) {
        super();
        this.engine = engine; // Gem en reference til Engine
    }

    public async loadModel(path: string): Promise<Object3D> {
        return new Promise((resolve, reject) => {
            this.load(
                `/storage/models/${path}.glb`,
                (gltf) => {
                    const model = gltf.scene;

                    model.position.set(0, 0, 0);
                    model.scale.set(1, 1, 1);

                    model.userData = {
                        identifier: path,
                        loadedAt: new Date().toISOString(),
                    };

                    console.log(model);

                    // Tilføj model til scenen via engine
                    this.engine.scene.add(model);

                    // Render scenen igen via engine
                    this.engine.render();

                    resolve(model);
                },
                undefined,
                (error) => {
                    console.error("Error loading model:", error);
                    reject(error);
                }
            );
        });
    }
}