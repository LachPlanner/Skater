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

                    const parser = gltf.parser;
                    const variantsExtension = gltf.userData.gltfExtensions?.['KHR_materials_variants'];

                    if (variantsExtension) {
                        const variants = variantsExtension.variants.map((variant: any) => variant.name);
                        model.userData.variants = variants;
                        model.userData.parser = parser;
                        model.userData.variantsExtension = variantsExtension;

                        console.log("Variants available:", variants);
                    }

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

    public selectVariant(model: Object3D, variantName: string): void {
        const { parser, variantsExtension } = model.userData;
        if (!parser || !variantsExtension) {
            console.warn("Model does not support material variants");
            return;
        }

        const variantIndex = variantsExtension.variants.findIndex((v: any) => v.name === variantName);

        model.traverse(async (object: any) => {
            if (!object.isMesh || !object.userData.gltfExtensions) return;

            const meshVariantDef = object.userData.gltfExtensions['KHR_materials_variants'];
            if (!meshVariantDef) return;

            if (!object.userData.originalMaterial) {
                object.userData.originalMaterial = object.material;
            }

            const mapping = meshVariantDef.mappings.find((mapping: any) =>
                mapping.variants.includes(variantIndex)
            );

            if (mapping) {
                object.material = await parser.getDependency("material", mapping.material);
                parser.assignFinalMaterial(object);
            } else {
                object.material = object.userData.originalMaterial;
            }
        });

        // Render the scene again to apply changes
        this.engine.render();
    }
}