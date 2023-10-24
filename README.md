```mermaid
graph TD
    subgraph User
        User
    end
    subgraph L7LBL
        CloudFront
        Cloud CDN
    end
    subgraph GCP
        Global
        "Cloud SQL (Read-only)"
    end
    subgraph VPC
        IAM
        subgraph MIG
            MIG1
            MIG2
        end
        "Cloud Datastore"
        "Cloud Storage"
    end

    User --> CloudFront
    CloudFront --> Cloud CDN
    CloudFront --> Global
    Global --> "Cloud SQL (Read-only)"
    Cloud CDN --> "Cloud SQL (Read-only)"
    Global --> IAM
    "Cloud SQL (Read-only)" --> MIG
    MIG --> "Cloud Datastore"
    MIG --> "Cloud Storage"
